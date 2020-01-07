$(document).ready(function () {
  //  alert(window.location.href);
    var req_num_row=10;
    var $tr=jQuery('tbody tr');
    var total_num_row=$tr.length;
    var num_pages=0;
    if(total_num_row % req_num_row ==0){
        num_pages=total_num_row / req_num_row;
    }
    if(total_num_row % req_num_row >=1){
        num_pages=total_num_row / req_num_row;
        num_pages++;
        num_pages=Math.floor(num_pages++);
    }
    jQuery('#pagination').append("<li class='page-item'><span class='page-link'>Total "+num_pages+"</span></li>");
    for(var i=1; i<=num_pages; i++){
        if(i ==1){jQuery('#pagination').append("<li class='page-item li'><a class='page-link actives' href=> "+i+" </a></li>");
        }else jQuery('#pagination').append("<li class='page-item li'><a class='page-link' href=> "+i+" </a></li>");
    }
    $tr.each(function(i){
        jQuery(this).hide();
        if(i+1 <= req_num_row){
            $tr.eq(i).show();
        }

    });
    var $pg= jQuery('.li');
    $pg.each(function(i){
        if(i > 10) jQuery(this).hide();
        /*if(i == page || i < (page + 5)  || i > (page - 5)){
            if(i >= 0 && i <= num_pages)$pg.eq(i).show();
        }*/

});
    jQuery('#pagination a').click(function(e){
        e.preventDefault();
        $tr.hide();
        var page=jQuery(this).text();
        var temp=page-1;
        var start=temp*req_num_row;
        //alert(start);
        var current_pag = document.getElementsByClassName("actives");
        //alert(current_pag[0].className);
        current_pag[0].className = current_pag[0].className.replace(" actives", "");
        this.className += " actives";
        $pg.hide();
        for(var s=0; s< num_pages; s++) {
            if ((page <= 6 && s < 11) ||(s < (parseInt(page) + 5) && s > (parseInt(page) - 7))) {
                if (s >= 0 && s <= num_pages) $pg.eq(s).show();
            }
        }
        for(var i=0; i< req_num_row; i++){

            $tr.eq(start+i).show();

        }
    });
});
