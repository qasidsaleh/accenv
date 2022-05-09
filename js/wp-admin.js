var $=jQuery.noConflict();
$(document).ready(function(){
	$('#general_product_data ._regular_price_field label').text('Cost ($)');
	$('.product_data_tabs .inventory_options span').text('Max Attendees');
	$('#inventory_product_data ._manage_stock_field label').text('Manage Attendee?');
	$('#inventory_product_data ._manage_stock_field span').text('Enable Manage Attendee');
	$('#inventory_product_data ._stock_field label').text('Max Attendee');
	$('.dropdown_product_cat > option:first').text('Select Course');
	//$(".taxonomy-product_cat p").text($(".taxonomy-product_cat p").text().replace('Product categories for your store can be managed here. To change the order of categories on the front-end you can drag and drop to sort them. To see more categories listed click the "screen options" link at the top-right of this page.', ""));
});