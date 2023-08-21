$(document).ready(function(){
    showNotes(); 
})

function showNotes() {
	$('.click-btn').click (function () {
        const $wrapper = $(this).closest('.category-note');
        $wrapper.toggleClass('open');
        $('p', $wrapper).stop().slideToggle(300);
	})
}

console.log('hello')