App.tickets = {
  controllers : {},
  models      : {}
};

/**
 * Tickets behavior
 */
App.tickets.controllers.tickets = {
  /**
   * Ticket index page behavior
   */
  index : function() {    
    $(document).ready(function () {
      reindex_tickets_table = function (table) {
        var counter = 0;
        table.find('li').each(function () {
          var row = $(this);
          if (row.html() && !row.is('.empty_row') && !row.is('.ui-sortable-helper')) {
            if ((counter % 2) == 0) {
              row.removeClass('even');
              row.addClass('odd');
            } else {
              row.removeClass('odd');
              row.addClass('even');
            } // if
            counter ++;
          } // if
        });
        if (counter<1) {
          table.find('.empty_row').show();
        } else {
          table.find('.empty_row').hide();
        } // if
      } // reindex_tickets_table

      if (App.data.can_manage_tickets) {
        $('.tickets_list').sortable({
          axis : 'y',      
          cursor: 'move',
          delay: 3,
          placeholder: 'drag_placeholder',
          forcePlaceholderSize : true,
          revert: false,
          connectWith: ['.tickets_list'],
          items: 'li.sort',
          update : function (e, ui) {
            var sortable_list = ui.item.parent();
            reindex_tickets_table(sortable_list);
            var reorder_data = sortable_list.find('input').serialize();
            if (reorder_data) {
              reorder_data+='&submitted=submitted';
              $.ajax({
                type: "POST",
                url: sortable_list.attr('reorder_url'),
                data: reorder_data
              });
            } // if
          },
          over: function (table_object,ui) {
            $(this).addClass('dragging');
          },
          out: function (table_object,ui) {
            $(this).removeClass('dragging');
          }
        });
      } // if
    });
  },
  
  /**
   * View ticket behavior
   */
  view : function() {
    $(document).ready(function() {
      $('#show_all_ticket_changes a').click(function() {
        var link = $(this);
        if(link.attr('loading') == 'loading') {
          return false;
        } else {
          link.attr('loading', 'loading');
        } // if
        
        var wrapper = $('#ticket_changes_wrapper');
        
        wrapper.block(App.lang('Loading...'));
        
        $.ajax({
          url : App.extendUrl(link.attr('href'), {async : 1}),
          success : function(response) {
            wrapper.empty().append(response).unblock().highlightFade();
            $('#show_all_ticket_changes').remove();
          },
          error : function() {
            wrapper.unblock();
            alert(App.lang('Failed to load all ticket changes'));
          }
        });
        
        return false;
      });
      
    setTimeout(function(){
        if($('.ticket').length && $('.object_options').length){
            if($('#accident_collection_id').length && $('#accident_project_id').length){
                console.log('Found Both Values');
                id = $('#accident_collection_id').val();
                proj = $('#accident_project_id').val();
                $('.object_options').append('<li><a href="/public/index.php?path_info=projects/'+proj+'/discussions/'+id+'"><span>Discuss this Job</span></a></li>');
            }    
        }
    },1500);
    
    $('.update-claimant-vin-data').attr('href',window.location);
    
    $('.update-claimant-vin-data').bind('click',function(event){
        
        var link = $(this);
        
        if(link.attr('loading') == 'loading') {
          return false;
        } else {
          link.attr('loading', 'loading');
        }
        
        event.preventDefault();
        var the_claimant = '';
        if($(this).hasClass('claimant-a-vin-link')) the_claimant = 'a';
        if($(this).hasClass('claimant-b-vin-link')) the_claimant = 'b';
        if($(this).hasClass('claimant-c-vin-link')) the_claimant = 'c';
        
        console.log('Going To Update VIN Data for Claimant '+the_claimant);
        
        existing_url = link.attr('href');
        existing_url = existing_url.substr(0,existing_url.indexOf('#'));
        
        the_url = App.extendUrl(existing_url,{async: 1});
        
        console.log('Vin Decode Url: '+the_url);
        $.ajax({
            url: the_url,
            type: 'POST',
            data: { submitted: 'submitted', claimant: the_claimant, vindecode: 1 },
            dataType: 'json',
            success: function(data){
                console.log(data);
                if(data.success){
                    link.removeAttr('loading');
                    $('div.claimant_'+the_claimant).append(data.html);    
                }                
            } 
        })
    });
      
      
    });
  }
  
};

(function($,undefined){

    $(function(){

        if($('#system_form_2').length){
            
            $('.job_specific_forms > div:visible').fadeOut('fast');  
            if($.browser.msie){
                $('select[name="service"] > option').bind('click',function(){
                value = $(this).val();
                change_visible_form(value);
                });
            } else {
                $('select[name="service"]').bind('change',function(){
                value = $(this).val();
                change_visible_form(value);
                });
            }
        } 
        
        
        
        
    });
})(jQuery);
