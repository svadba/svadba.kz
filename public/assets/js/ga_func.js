/**
 * Created by 1 on 29.05.14.
 */

function ga_ext_link(link){
    ga('send', 'pageview', link);
}
function ga_show_company_info(company_id){
    ga('send', 'event', 'button_info', 'show_company_info', 'show_company_info_'+company_id );
    $('.company_info_wrap').removeClass('blured');
    $('.company_info_blur').hide();
    $('.no_copy').hide();
    $.get('/company/view_contact_info/'+company_id);
}
function ga_help_menu(menu_id){
    ga('send', 'event', 'button_help_menu', 'help_menu',  'help_menu_' + menu_id);

}
function ga_company_link(company_id){
    ga('send', 'event', 'company_link', 'show_company_page', 'show_company_page_' + company_id );
}
