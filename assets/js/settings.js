jQuery(document).ready(function (e) {
  jQuery(".nl-color-picker").wpColorPicker();

  jQuery(".nav-item").click(function (e) {
    e.preventDefault();
    jQuery(".nav-item").removeClass("active");
    jQuery(this).addClass("active");
    var id_var = jQuery(this).attr("id");
    jQuery("." + id_var)
      .show()
      .siblings()
      .hide();
  });

  /***Submit handler for branding form ***/
  jQuery("#form_branding_submit").click(function (e) {
    jQuery("#loader, .ss-overlay-custom").show();
    e.preventDefault();
    var ajaxurl = OBJ.AJAX_URL;
    var branding_data = jQuery("#form_branding").serialize();
    var data = {
      action: "branding_data_save",
      branding_data: branding_data,
    };
    jQuery.post(ajaxurl, data, function (response) {
      jQuery(".settings_page .updated_notice_custom").show();
      jQuery("#loader, .ss-overlay-custom").hide();
    });
  });

  /***Submit handler for gdpr form ***/
  jQuery("#form_gdpr_submit").click(function (e) {
    e.preventDefault();

    jQuery("#loader, .ss-overlay-custom").show();

    var ajaxurl = OBJ.AJAX_URL;
    var form_GDPR = jQuery("#form_GDPR").serialize();
    console.log(form_GDPR);
    var data = {
      action: "GDPR_data_save",
      form_GDPR: form_GDPR,
    };
    jQuery.post(ajaxurl, data, function (response) {
      jQuery(".settings_page .updated_notice_custom").show();
      jQuery("#loader, .ss-overlay-custom").hide();
    });
  });

  /***Submit handler for gutenberg form ***/

  jQuery("#disable_gutenburg").click(function (e) {
    jQuery("#loader, .ss-overlay-custom").show();
    e.preventDefault();
    jQuery.ajax({
      url: OBJ.AJAX_URL,
      type: "POST",
      data: {
        action: "gutenberg_data_save",
        data: jQuery("#form_gutenberg").serialize(),
      },
      success: function (data) {
        jQuery(".settings_page .updated_notice_custom").show();
        jQuery("#loader, .ss-overlay-custom").hide();
      },
    });
  });

  /***Submit handler for Duplicate post form ***/

  jQuery("#duplicate_posts_save").click(function (e) {
    jQuery("#loader, .ss-overlay-custom").show();
    e.preventDefault();
    var form_duplicate = jQuery("#form_duplicate").serialize();
    jQuery
      .post(
        OBJ.AJAX_URL + "?action=duplicate_posts_settings_save",
        form_duplicate
      )
      .done(function (res) {
        jQuery(".settings_page .updated_notice_custom").show();
        jQuery("#loader, .ss-overlay-custom").hide();
      });
  });

  /***Submit handler for Custom Code form ***/

  jQuery("#custom_code_id").click(function (e) {
    jQuery("#loader, .ss-overlay-custom").show();
    e.preventDefault();
    var custom_code = jQuery("#form_custom_code").serialize();
    jQuery.ajax({
      url: OBJ.AJAX_URL,
      type: "POST",
      data: {
        action: "save_custom_code",
        custom_code: custom_code,
      },
      success: function (data) {
        jQuery(".settings_page .updated_notice_custom").show();
        jQuery("#loader, .ss-overlay-custom").hide();
      },
    });
  });

  /***Submit handler for Security meta form ***/

  jQuery("#form_security_submit").click(function (e) {
    e.preventDefault();
    jQuery("#loader, .ss-overlay-custom").show();

    jQuery.ajax({
      url: OBJ.AJAX_URL,
      type: "POST",
      data: {
        action: "security_audit_check",
        pdata: jQuery("#form_security").serialize(),
      },
      success: function (data) {
        jQuery(".settings_page .updated_notice_custom").show();
        jQuery("#loader, .ss-overlay-custom").hide();
      },
    });
  });

  jQuery(document)
    .find(".icon_picker")
    .iconpicker({ defaultValue: "fa fa-facebook" });

  jQuery(".addSocial").click(function () {
    jQuery(".optionBox").append(
      '<div class="block"><div class="main_block_social"><p><input type="text" class="icon_picker" name="social[]" /><span class="input-group-addon"><i class="fas fa-facebook"></i></span></p><input type="text" name="social_link[]" value="#" /></div><span class="remove"><i class="fa fa-times" aria-hidden="true"></i></span></div>'
    );
    jQuery(document)
      .find(".icon_picker")
      .iconpicker({ defaultValue: "fa fa-facebook" });
  });

  jQuery(".optionBox").on("click", ".remove", function () {
    jQuery(this).parent().remove();
  });

  /***Submit handler for Social media form ***/

  jQuery("#form_social_submit").click(function (e) {
    jQuery("#loader, .ss-overlay-custom").show();
    e.preventDefault();
    var social = jQuery("#form_id").serialize();
    jQuery.ajax({
      url: OBJ.AJAX_URL,
      type: "POST",
      data: {
        action: "save_social_media",
        social: social,
      },
      success: function (data) {
        jQuery(".settings_page .updated_notice_custom").show();
        jQuery("#loader, .ss-overlay-custom").hide();
      },
    });
  });

  jQuery("#security_audit").click(function (e) {
    e.preventDefault();

    jQuery("#req_modal").modal("show");
    jQuery(".req_form_email").find(".service_name").val("Security Audit");
    jQuery(".req_form_email").find(".parent_service").val("security_audit");
  });

  /***Submit handler for Request Service ***/

  jQuery(document).on("click", ".request_service", function () {
    jQuery("#req_modal").modal("show");
    jQuery(".req_form_email")
      .find(".service_name")
      .val(jQuery(this).attr("attr_name"));
    jQuery(".req_form_email").find(".parent_service").val("marketplace");
  });

  /***Submit handler for footer settings form ***/

  jQuery(document).on("click", ".form_footer_settings_submit", function (e) {
    jQuery("#loader, .ss-overlay-custom").show();
    e.preventDefault();
    var ajaxurl = OBJ.AJAX_URL;
    tinyMCE.triggerSave();
    var footer_settings = jQuery("#footer_settings_form").serialize();
    jQuery
      .post(ajaxurl + "?action=footer_settings_save", footer_settings)
      .done(function (response) {
        jQuery(".settings_page .updated_notice_custom").show();
        jQuery("#loader, .ss-overlay-custom").hide();
      });
  });

  /** Req Email service */
  jQuery(".req_form_email_submit").click(function (e) {
    e.preventDefault();
    var cname = jQuery(".req_form_email").find(".cname");
    var cemail = jQuery(".req_form_email").find(".cemail");

    if (!jQuery(cname).val()) {
      jQuery(cname).addClass("error_modal");
      return false;
    } else {
      jQuery(cname).removeClass("error_modal");
    }

    if (!isEmail(jQuery(cemail).val())) {
      jQuery(cemail).addClass("error_modal");
      return false;
    } else {
      jQuery(cemail).removeClass("error_modal");
    }

    var service_parent = jQuery(".req_form_email")
      .find(".parent_service")
      .val();

    if (service_parent == "marketplace") {
      jQuery(".modal-overlay-custom").show();

      jQuery
        .post(
          OBJ.AJAX_URL + "?action=marketplace_email",
          jQuery(".req_form_email").serialize()
        )
        .done(function () {
          jQuery(".modal-overlay-custom").hide();

          var modal_html =
            '<div class="thank-you"><div class="tick-icon"><i class="fa-8x far fa-check-circle"></i></div><h3>Thank you for your interest, We will get in touch shortly!</h3></div>';

          jQuery("#req_modal .modal-body").html(modal_html);

          setTimeout(function () {
            location.reload(true);
          }, 800);
        });
    } else if (service_parent == "security_audit") {
      jQuery(".modal-overlay-custom").show();

      jQuery
        .post(
          OBJ.AJAX_URL + "?action=security_audit",
          jQuery(".req_form_email").serialize()
        )
        .done(function () {
          jQuery(".modal-overlay-custom").hide();

          var modal_html =
            '<div class="thank-you"><div class="tick-icon"><i class="fa-8x far fa-check-circle"></i></div><h3>Thank you for your interest, We will get in touch shortly!</h3></div>';

          jQuery("#req_modal .modal-body").html(modal_html);

          setTimeout(function () {
            location.reload(true);
          }, 800);
        });
    }
  });
});

//media upload functions
function clear_uploader_image(id) {
  jQuery("#" + id).val("");
}

function open_media_uploader_image(id) {
  media_uploader = wp.media({
    frame: "post",
    state: "insert",
    multiple: false,
  });
  media_uploader.on("insert", function () {
    var length = media_uploader.state().get("selection").length;
    var images = media_uploader.state().get("selection").models;

    for (var iii = 0; iii < length; iii++) {
      var image_url = images[iii].changed.url;
      var image_caption = images[iii].changed.caption;
      var image_title = images[iii].changed.title;
      jQuery("#" + id).val(image_url);
    }
  });
  media_uploader.open();
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
