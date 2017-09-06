/**
 * Created by abaudoin on 5.9.2017..
 */
$( document ).ready(function() {

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $("ul.sidebar-nav li.filter-item").click(function () {
        $(this).next().toggleClass("hidden");
    });

    $("#filter-button").click(function(){
        var minPrice = $('#min-price').val();
        var maxPrice = $('#max-price').val();
        var ram = $('input[name=ram]:checked').map(function () { return this.value; }).toArray();

        $.ajax({
            type: 'post', // performing a POST request
            data : {
                price : {
                    minPrice : minPrice,
                    maxPrice : maxPrice
                },
                ram : ram,
                brand : [],
                state : []
            },
            url: "/filter", success: function(result){
            $("#page-content-wrapper").html(result);
        }});
    });
});