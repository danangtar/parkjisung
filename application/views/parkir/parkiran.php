    <body>
        <div class="wrapper">
            <div class="container">
                <h1>Floor #1</h1>
                <h1><?php echo $user;?></h1>
                <p>Where do you want to park your car?</p>
                <div id="seat-map">
                    <div class="front-indicator">Entrance/Exit</div>
                </div>
                <div class="booking-details">
                    <h2>Booking Details</h2>
                    <h3> Floor Selection:</h3>
                    <select class="floor-select" onchange="location = this.value;">
                        <option value="parkiran.php">Floor #1</option>
                        <option value="parkiran.php">Floor #2</option>
                        <option value="parkiran.php">Floor #3</option>
                        <option value="parkiran.php">Floor #4</option>
                    </select> 
                    <h3> Selected Slot:</h3>
                    <ul id="selected-seats"></ul>
                    
                    <div id="legend"></div>
                </div>
            </div>
        </div>

        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url();?>assets/jQuery-Seat-Charts/jquery.seat-charts.js"></script>

        <script>
            var firstSeatLabel = 1;

            $(document).ready(function() {
                var $cart = $('#selected-seats'),
                    counter = 0,
                    sc = $('#seat-map').seatCharts({
                    map: [
                        'o_o_o',
                        'o_o_o',
                        'o_o_o',
                        'o_o_o',
                        'o_o_o',
                        'o_o_o',
                        'o_o_o',
                        'o___o',
                        'ooooo',
                    ],
                    seats: {
                        o: {
                            //price     : 100,
                            classes   : 'available-slot', //your custom CSS class
                            category  : 'Parking Slot',
                            description : 'Available Slot!'
                        }			

                    },
                    naming : {
                        top : false,
                        getLabel : function (character, row, column) {
                            return firstSeatLabel++;
                        },
                    },
                    legend : {
                        node : $('#legend'),
                        items : [
                            [ 'o', 'available',   'Available Slot' ],
                            [ 'o', 'unavailable', 'Already Booked' ],
                            [ 'o', 'selected', 'Selected' ]
                        ]					
                    },
                    click: function () {
                        if (this.status() == 'available' && counter == 0) {
                            //let's create a new <li> which we'll add to the cart items
//                            $("<li>"+this.data().category+' #'+this.settings.label+' #'+this.settings.id+': <a href="#" class="cancel-cart-item">[cancel]</a></li>')
                            $("<li>"+'<form action="<?php echo base_url();?>Parkir/bookspot" method="post">'+'<input type="hidden" name ="spot" value="'+this.settings.label+'">'+'<input type="hidden" name ="id" value="<?php echo $user;?>">'+'<button type="submit" class="checkout-button">Book Now &raquo;</button>'+"</form></li>")
                                .attr('id', 'cart-item-'+this.settings.id)
                                .data('seatId', this.settings.id)
                                .appendTo($cart);

                            counter++;

                            return 'selected';
                        } 
    //                        else if (this.status() == 'available' && counter == 1) {
    //                            var temp = String($('ul').find('li')[0].id);
    //                            $("#"+temp).remove();
    //                            var id = temp.split("-")[2];
    //                            $("#"+id).attr('aria-checked','false');
    //                            $("#"+id).removeClass('selected').addClass('available');
    //                            $("#"+this.settings.id).addClass('selected');
    //                            $('<li>'+this.data().category+' # '+this.settings.label+': <a href="#" class="cancel-cart-item">[cancel]</a></li>')
    //								.attr('id', 'cart-item-'+this.settings.id)
    //								.data('seatId', this.settings.id)
    //								.appendTo($cart);
    //                        } 
                        else if (this.status() == 'selected') {
                            //update the counter
                            --counter;

                            //remove the item from our cart
                            $('#cart-item-'+this.settings.id).remove();

                            //seat has been vacated
                            return 'available';
                        } else if (this.status() == 'unavailable') {
                            //seat has been already booked
                            return 'unavailable';
                        } else {
                            return this.style();
                        }
                    }
                });

                //this will handle "[cancel]" link clicks
                $('#selected-seats').on('click', '.cancel-cart-item', function () {
                    //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
                    sc.get($(this).parents('li:first').data('seatId')).click();
                });

                //let's pretend some seats have already been booked
//                sc.get(['1_1', '4_1', '7_1', '7_3']).status('unavailable');
                sc.get([<?php   $spots = count($vacant);
                                foreach ($vacant as $spot) {
                                    echo "'".$spot->POSISISPOT."'";
                                    if($spots>1) {
                                        echo ", ";
                                    }  
                                }?>]).status('unavailable');


        });

        </script>
    </body>
    </html>