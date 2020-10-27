
                                                   <table class="display table table-striped table-bordered nowrap cusTableStyle" width="100%" cellspacing="0"  id="comm_stat_level_{{$req_level}}">
                                 <thead>
                                    <tr>
                                        <th>SR No.</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        
                                        <th>IB Code</th>
                                        
                                        <th>Account No.</th>
                                        <th>Account Type.</th>
                                        
                                        <th>Time</th>
                                        
                                        <th>Type</th>
                                        <th>Instrument</th>
                                        <th>Lots</th>
                                        <th>Commission</th>
                                        
                                    
                                        
                                    </tr>
                               </thead>
                               <tbody>
                                    @foreach($mt5_orders_history as $key=>$moh)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$moh->fname}} {{$moh->lname}}</td>
                                        <td>{{$moh->country}}</td>
                                        
                                        
                                        <td>{{$moh->affiliate_prom_code}}</td>
                                    
                                        <td>{{$moh->account_no}}</td>
                                        <td>{{$moh->act_type}}</td>
                                        
                                        <td>{{$moh->TimeDone}}</td>
                                        <td>
                                            @if($moh->Type==0)
                                            Buy
                                        @else
                                            Sell
                                        @endif
                            </td>
                                        <td>{{$moh->Symbol}}</td>

                                        
                                       <td>{{round($moh->volume,2)}}</td>
                                        <td>{{round($moh->ib_commission,2)}}</td>
                                        
                                    </tr>
                                   @endforeach 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th colspan="9">Total:</th>
                                        <th>{{$total_volume}}</th>
                                        <th>{{$total_ib_commission}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                                

        

        
       



                               