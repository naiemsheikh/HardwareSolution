<?php                   
$ch = curl_init("https://raw.githubusercontent.com/naiemsheikh/Rest-API-PHP-7/master/project/posts.txt");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $respons = curl_exec($ch);
        curl_close($ch);
		$data = json_decode($respons, true);
		// var_dump($data);
// 		foreach($data as $key){
// echo $key['userId'], " ",
//  $key['id'], " ",
//  $key['title'], " ";
// 		}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">

</head>

<style>
	.page-item.active .page-link{
		z-index: 3;
    color: #fff;
    background-color: #1e7e34;
    border-color: #1e7e34;
	}
</style>
<body>

    <div class="container">
        <h2>Basic test</h2>


        <!--		Show Numbers Of Rows 		-->
        
		<div class="row">
            <div class="col-lg-3">
                <div class="form-group">

                    <select class="form-control" name="state" id="maxRows">


                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="70">70</option>
                        <option value="100">100</option>
                        <option value="5000">Show ALL Rows</option>
                    </select>
                </div>
            </div>
			<div class="col-lg-6"></div>
            <div class=" col-lg-3">
                <div class="tb_search">
                    <input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
                </div>
            </div>
        </div>


        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    
                    <th class="th-sm">User ID </th>
                    <th class="th-sm">Title </th>
                    <th class="th-sm">Action </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $key) : ?>

                <tr>
                    <td><?= $key["userId"]?></td>
                    <td><?= $key["title"]?></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#exampleModalCenter<?= $key["id"]?>">
                            Details
                        </button>


                        <div class="modal fade" id="exampleModalCenter<?= $key["id"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Details of information
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modal_details_data">
                                        <?= $key["body"] ?>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <?php endforeach; ?>

                <!-- wirte your code -->

            </tbody>

        </table>


        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>


        <div style="width: 20%;float:right;text-align:right;color: #999;" class="rows_count">Showing 11 to 20 of 91
            entries
        </div>


    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
// write your js code
getPagination('#dtBasicExample');
$('#maxRows').trigger('change');

function getPagination(table) {

    $('#maxRows').on('change', function() {
        $('.pagination').html(''); // reset pagination div
        var trnum = 0; // reset tr counter 
        var maxRows = parseInt($(this).val()); // get Max Rows from select option

        var totalRows = $(table + ' tbody tr').length; // numbers of rows 
        $(table + ' tr:gt(0)').each(function() { // each TR in  table and not the header
            trnum++; // Start Counter 
            if (trnum > maxRows) { // if tr number gt maxRows

                $(this).hide(); // fade it out 
            }
            if (trnum <= maxRows) {
                $(this).show();
            } // else fade in Important in case if it ..
        }); //  was fade out to fade it in 
        if (totalRows > maxRows) { // if tr total rows gt max rows option
            var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..  
            //	numbers of pages 
            for (var i = 1; i <= pagenum;) { // for each page append pagination li 
                $('.pagination').append('<li class="page-item" data-page="' + i + '">\
								      <a class="page-link">' + i++ + '<span class="sr-only">(current)</span></a>\
								    </li>').show();
            } // end for i 


        } // end if row count > max rows
        $('.pagination li:first-child').addClass('active'); // add active class to the first li 


        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
        showig_rows_count(maxRows, 1, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

        $('.pagination li').on('click', function(e) { // on click each page
            e.preventDefault();
            var pageNum = $(this).attr('data-page'); // get it's number
            var trIndex = 0; // reset tr counter
            $('.pagination li').removeClass('active'); // remove active class from all li 
            $(this).addClass('active'); // add active class to the clicked 


            //SHOWING ROWS NUMBER OUT OF TOTAL
            showig_rows_count(maxRows, pageNum, totalRows);
            //SHOWING ROWS NUMBER OUT OF TOTAL



            $(table + ' tr:gt(0)').each(function() { // each tr in table not the header
                trIndex++; // tr index counter 
                // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) -
                        maxRows)) {
                    $(this).hide();
                } else {
                    $(this).show();
                } //else fade in 
            }); // end of for each tr in table
        }); // end of on click pagination list
    });
    // end of on select change 

    // END OF PAGINATION 

}




// SI SETTING
$(function() {
    // Just to append id number for each row  
    default_index();

});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
    //Default rows showing
    var end_index = maxRows * pageNum;
    var start_index = ((maxRows * pageNum) - maxRows) + parseFloat(1);
    var string = 'Showing ' + start_index + ' to ' + end_index + ' of ' + totalRows + ' entries';
    $('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
    $('table tr:eq(0)').prepend('<th> ID </th>')

    var id = 0;

    $('table tr:gt(0)').each(function() {
        id++
        $(this).prepend('<td>' + id + '</td>');
    });
}

// All Table search script
function FilterkeyWord_all_table() {

    // Count td if you want to search on all table instead of specific column

    var count = $('.table').children('tbody').children('tr:first-child').children('td').length;

    // Declare variables
    var input, filter, table, tr, td, i;
    input = document.getElementById("search_input_all");
    var input_value = document.getElementById("search_input_all").value;
    filter = input.value.toLowerCase();
    if (input_value != '') {
        table = document.getElementById("dtBasicExample");
        tr = table.getElementsByTagName("tr");
		console.log(tr);
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {

            var flag = 0;

            for (j = 0; j < count; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {

                    var td_text = td.innerHTML;
                    if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        //var td_text = td.innerHTML;  
                        //td.innerHTML = 'shaban';
                        flag = 1;
                    } else {
                        //DO NOTHING
                    }
                }
            }
            if (flag == 1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    } else {
        //RESET TABLE
        $('#maxRows').trigger('change');
		
    }
}
</script>
</body>


<!-- Modal -->



</html>
