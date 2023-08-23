$(document).ready(function(){
    showNotes(); 
})

function showNotes() {
	$('.click-btn').click (function () {
        
        const $wrapper = $(this).closest('.category-note');
        $wrapper.toggleClass('close');
        $('p', $wrapper).stop().slideToggle(300);
	})
}

console.log('hello')


$('.click-btn').click (function () {
    $('.category-note').toggleClass('close', 10000, "easeOutSine")
    console.log('clicked')
})