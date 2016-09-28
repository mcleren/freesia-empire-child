jQuery(document).ready(function(){
    /*
	use datepicker for date field in a meta box field with class="datepicker"
	*/
	if(jQuery().datepicker) {
		jQuery('.datepicker').datepicker();
	}
	
	/*
	use sorting lists in a meta box field, <ul class="sortable">
	use adding element in lists in a meta box field, <a id="add-row">
	use removing element in lists in a meta box field, <a class="remove-row">
	*/
	jQuery( '#add-row' ).on('click', function() {
		var row = jQuery( '.empty-row.screen-reader-text' ).clone(true);
		row.removeClass( 'empty-row screen-reader-text' );
		row.insertBefore( '#repeatable-fieldset-one li:last' );
		return false;
	});

	//jQuery( '.remove-row' ).on('click', function() {
	jQuery(document).on('click', '.remove-row', function() {	
		jQuery(this).parents('li').remove();
		return false;
	});
	
	if(jQuery().sortable) {
		jQuery( '.sortable' ).sortable({
			opacity: 0.6,
			revert: true,
			cursor: 'move',
			handle: '.hndle',
			placeholder: {
				element: function(currentItem) {
					return jQuery("<li style='background:#E7E8AD'>&nbsp;</li>")[0];
				},
				update: function(container, p) {
					return;
				}
			}
		}).disableSelection();
	}
	//jQuery( '.sortable' ).disableSelection();
});