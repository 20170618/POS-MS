@extends('masterlayout.adminlayout')

@section('location')
    REPORTS
@endsection


@section('content')

    <div class="container" style="margin-top: 10px;width: 50rem">

        <div class="card text-white mb-3 blue-bg">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="nav nav-pills flex-column">
                            <h2>
                                <li class="yellow">
                                    <i class="fas fa-file-alt yellow" style="margin-right: 1rem"></i>
                                    REPORT GENERATOR
                                </li>
                            </h2>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="container">
 
                        <div class="row" style="text-align: center" id="customDateDiv">

                            <form method="POST" action="{{route('admin.reportGenerate')}}">
                                @csrf
                                @method('GET')

                            <div class="col">

                                <div class="row">
                                    <div class="form-group">
                                        <label class="form-label mt-4 yellow">Start Date</label>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" placeholder="Date"
                                                    aria-label="Recipient's username" aria-describedby="button-addon2"
                                                    id="startDate" name="startDate" required>
                                                <!--<button class="btn btn-yellow" type="button" id="button-addon2"><i class="fas fa-calendar-alt fa-lg"></i></button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="form-label mt-4 yellow">End Date</label>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" placeholder="Date"
                                                    aria-label="Recipient's username" aria-describedby="button-addon2"
                                                    id="endDate" name="endDate" required>
                                                {{-- <button class="btn btn-yellow" type="button" id="button-addon2"><i class="fas fa-calendar-alt fa-lg"></i></button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="form-label mt-4 yellow">Filters</label>
                    <div class="card border-secondary mb-3">
                        <div class="card-body gray">
                            <div class="row">

                                <div class="col">
                                    <h6 style="text-align: center">Category</h6>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input allCheck" type="checkbox" value="allCheck" id="allCheck" name="Category[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            All
                                        </label>

                                    </div>

                                    <hr>

                                    <div class="form-check">
                                        <input class="form-check-input allCheck" type="checkbox" value="Consumable" id="consumable" name="Category[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Consumable
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input allCheck" type="checkbox" value="Non-Consumable" id="nonConsumable" name="Category[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Non-Consumable
                                        </label>
                                   </div>

                                    <div class="form-check">
                                        <input class="form-check-input allCheck" type="checkbox" value="E-Load" id="eLoadRegular" name="Category[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            E-Load
                                        </label>
                                    </div>                      
                                    </fieldset>



                                </div>

                                <div class="col">
                                    <h6 style="text-align: center">Mode of Payment</h6>

                                    <div class="form-check">
                                        <input class="form-check-input allCheck2" type="checkbox" value="allCheck2"
                                            id="allCheck2" name="modeOfPayment[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            All
                                        </label>
                                    </div>

                                    <hr>

                                    <div class="form-check">
                                        <input class="form-check-input allCheck2" type="checkbox" value="Cash"
                                            id="cash" name="modeOfPayment[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Cash
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input allCheck2" type="checkbox" value="Credit"
                                            id="credit" name="modeOfPayment[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Credit
                                        </label>
                                    </div>

                                   

                                
                                    </fieldset>



                                </div>                         

                            </div>
                        </div>
                    </div>
                </div>  

                <small>At least one filter is required for both category and mode of payment.</small>



            </div>
            <div class="card-footer" style="text-align: right">
            <button class="btn btn-yellow" id="GenerateButton" type="submit">Download</button>
            <!--<a class="btn btn-yellow" href="../reportPreview"><b>Generate</b></a>-->
          
            </div>

            
        </form>
        </div>







    </div>

    <script>
        $(document).ready(function() {

            //Check box for Category
            $('input[type=checkbox][class=Category]').change(function() {
                if (this.value == 'allCheck') {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"][class=Category]');
                    for (var checkbox of checkboxes) {
                        checkbox.checked = this.checked;
                    }

                } else {
                    document.getElementById("allCheck").checked = false;
                }
            });

            $('#allCheck').change(function(){
                if (document.getElementById('allCheck').checked) {
                    document.getElementById('consumable').checked = false;
                    document.getElementById('consumable').disabled = true;

                    document.getElementById('nonConsumable').checked = false;
                    document.getElementById('nonConsumable').disabled = true;

                    document.getElementById('eLoadRegular').checked = false;
                    document.getElementById('eLoadRegular').disabled = true;

                    document.getElementById('eLoadPromo').checked = false;
                    document.getElementById('eLoadPromo').disabled = true;
                }else{
                    document.getElementById('consumable').checked = false;
                    document.getElementById('consumable').disabled = false;

                    document.getElementById('nonConsumable').checked = false;
                    document.getElementById('nonConsumable').disabled = false;

                    document.getElementById('eLoadRegular').checked = false;
                    document.getElementById('eLoadRegular').disabled = false;

                    document.getElementById('eLoadPromo').checked = false;
                    document.getElementById('eLoadPromo').disabled = false;
                }
            });

            $('#allCheck2').change(function(){
                if (document.getElementById('allCheck2').checked){
                    document.getElementById('cash').checked = false;
                    document.getElementById('cash').disabled = true;

                    document.getElementById('credit').checked = false;
                    document.getElementById('credit').disabled = true;
                }else{
                    document.getElementById('cash').checked = false;
                    document.getElementById('cash').disabled = false;

                    document.getElementById('credit').checked = false;
                    document.getElementById('credit').disabled = false;
                }
            })

            //Check box for Category
            $('input[type=checkbox][name=modeOfPayment]').change(function() {
                if (this.value == 'allCheck2') {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"][name=modeOfPayment]');
                    for (var checkbox of checkboxes) {
                        checkbox.checked = this.checked;
                    }

                } else {
                    document.getElementById("allCheck2").checked = false;
                }
            });

            //Generate Report Button on Click
            /*
            $('#GenerateButton').click(function(e) {
                e.preventDefault();
                var startDate = document.getElementById("startDate").value;
                var endDate = document.getElementById("endDate").value;
                var data = {
                    'startDate': startDate,
                    'endDate': endDate
                }
                console.log(data);

               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "reports/preview",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log("works");
                    }
                    
                });
            });
            */

            //Time limiter for End Date Input
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("endDate").setAttribute("max",
                today);
            document.getElementById("startDate").setAttribute("max", today);


        });
    </script>

@endsection
