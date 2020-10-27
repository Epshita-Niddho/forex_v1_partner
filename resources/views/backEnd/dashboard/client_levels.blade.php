
                                                   <table class="display table table-striped table-bordered nowrap cusTableStyle" width="100%" cellspacing="0"  id="comm_stat_level_{{$req_level}}">
                                 <thead>
                                    <tr>
                                        <th>SR No.</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        
                                        <th>IB Code</th>
                                        
                                        
                                        <th>Registration Time</th>
                                        
                                    
                                        
                                    </tr>
                               </thead>
                               <tbody>
                                    @foreach($clients as $key=>$client)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$client->fname}} {{$client->lname}}</td>
                                        <td>{{$client->country}}</td>
                                        
                                        
                                        <td>{{$client->affiliate_prom_code}}</td>
                                    
                                        <td>{{$client->reg_time}}</td>
                                        
                                        
                                    </tr>
                                   @endforeach 
                                    </tbody>
                                    
                                </table>
                                                

        

        
       



                               