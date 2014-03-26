
<script language="javascript" type="text/javascript">

  var eisr = '';
  
  eisr += '<div id="email-invite-selector-root" class="email-invite-selector-wrapper" style="display: none;>';
  eisr += '  <div class="email-invite-selector">';
  eisr += '  ';
  eisr += '    <h3><?php print t('Add email people you know for invite them to support project'); ?></h3>';
  eisr += '    <form method="post" action="" id="email-invite-selector-form">';
  eisr += '      <p class="email-invite-search-wrapper">';
  eisr += '        <label for="email-invite-search-id"><?php print t('Type for search your contacts'); ?></label>';
  eisr += '        <input id="email-invite-search-id" class="email-invite-search" value="" name="email_invite_search" />';
  eisr += '      </p>';
  eisr += '      <p class="filter"><?php print t('Choose whom to email') ?>: <a href="#" class="select-all"><?php print t('select all'); ?></a>/ <a href="#" class="select-none"><?php print t('none'); ?></a> </p>';
  eisr += '  ';
  eisr += '      <ul class="email-invite-selector-list">';
  eisr += '      </ul>';
  eisr += '      <input class="email-invite-add" type="submit" value="<?php print t('Add'); ?>" />';
  eisr += '      <span class="email-invite-or"><?php print t('or'); ?></span>';
  eisr += '      <a class="email-invite-close" href="#"><?php print t('close'); ?></a>';
  eisr += '    </form>';
  eisr += '  ';
  eisr += '  </div>';
  eisr += '</div>';
  
  eisr = $(eisr);


  $('body').append(eisr);

  function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
      if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
  }

  $('.email-invite-search').keyup(function (e) {

    var keyword = $(this).val().toLowerCase();
    
    if (keyword) {

      $('.email-invite-selector-item').each(function () {
        if ($(this).text().toLowerCase().indexOf(keyword) >= 0) {
          $(this).show();
        }
        else {
          $(this).hide();
        }
      });

    }
    else {
      $('.email-invite-selector-item').show();    
    }

  });

  $('.email-invite-search').focus(function () {
    $('label[for=email-invite-search-id]').hide();
  }).blur(function () {
    
    if (!$(this).val()) {
      $('label[for=email-invite-search-id]').show();
    }

  });

  window.pullContacts = function (form_id, field_name, contacts) {

    $('#email-invite-selector-root').show();
    $('.email-invite-selector-list').html('');

    $.each(contacts, function (email, name) {

      var template = ' <li class="email-invite-selector-item"> <span class="email-invite-checkbox email-invite-col"> <input type="checkbox" name="recipients[]" value="' + email + '" /> </span> <span class="email-invite-name email-invite-col"> ' + name + ' </span> <span class="email-invite-email email-invite-col"> ' + email + ' </span> </li> ';

      $('.email-invite-selector-list').append(template);
    });


    $('.email-invite-selector-wrapper').show();

    $('.select-all').click(function (e) {
      e.preventDefault();
      $('.email-invite-checkbox input').attr('checked','checked');
    });
    $('.select-none').click(function (e) {
      e.preventDefault();
      $('.email-invite-checkbox input').removeAttr('checked');
    });
  
    $('#email-invite-selector-form').submit(function (e) {
      e.preventDefault();
  
      var input_target = $('form#' + form_id + ' #edit-' + field_name);
      var checked_contacts = input_target.val().split('\n');

      $('.email-invite-checkbox input:checked').each(function () {
        checked_contacts.push($(this).val());
      });

      input_target.val(unique(checked_contacts).join('\n').trim());
      $('#email-invite-selector-root').hide();
    });
    
    $('.email-invite-close').click(function (e) {
      e.preventDefault();
      $('#email-invite-selector-root').hide();
    });

  };

</script>
