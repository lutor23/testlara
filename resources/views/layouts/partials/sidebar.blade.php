<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
            </div>
        </div>
        @endif

               

            <li class="header">Dashboards</li>

    	
    		<!-- Directors group  -->
            <li class="treeview">
                <a href="#"><i class='fa fa-user'></i> <span>Directors</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                      @foreach($directors as $director)
                        <li class="active"><a href="{{ url('director/'.$director->id) }}"><i class='fa fa-pie-chart'></i> <span> {!! $director->name !!} </span>
                            <span class="pull-right-container">

                                @if ($director->warning_count['success']>0)
                                <small class="label pull-right bg-green">{{$director->warning_count['success']}}</small> 
                                @endif
                                
                                @if ($director->warning_count['warning']>0)
                                <small class="label pull-right bg-yellow">{{$director->warning_count['warning']}}</small> 
                                @endif
                                
                                @if ($director->warning_count['critical']>0)
                                <small class="label pull-right bg-red">{{$director->warning_count['critical']}}</small> 
                                @endif

                          </span></a>
                        </li>
                      @endforeach
                </ul>
            </li>


            <!-- Dashboards by team -->

    		@foreach($teams as $team)
                @if ( count($team->dashboards->pluck('title'))>0 )

        		<li class="treeview">

                    <a href="#"><i class='fa fa-dashboard'></i> <span>{!! $team->name !!}</span>
        			<span class="pull-right-container">

                        @if ($team->warning_count['success']>0)
                        <span class="pull-right-container"><small class="label pull-right bg-green">{{$team->warning_count['success']}}</small> </span> 
                        @endif
                        
                        @if ($team->warning_count['warning']>0)
                        <span class="pull-right-container"><small class="label pull-right bg-yellow">{{$team->warning_count['warning']}}</small> </span> 
                        @endif
                        
                        @if ($team->warning_count['critical']>0)
                        <span class="pull-right-container"><small class="label pull-right bg-red">{{$team->warning_count['critical']}}</small> </span> 
                        @endif


        			</span></a>

                    <ul class="treeview-menu"> 
                        @foreach($team->dashboards as $dashboard)         
                        <li><a href="/dashboard/{!! $dashboard->id !!}"> 

                            
                            @if ($dashboard->warning_count['critical']>0)
                            <span class="pull-left-container"><small class="label pull-left bg-red">{{$dashboard->warning_count['critical']}}</small> </span> 
                            @endif
                            
                            @if ($dashboard->warning_count['warning']>0)
                            <span class="pull-left-container"><small class="label pull-left bg-yellow">{{$dashboard->warning_count['warning']}}</small> </span> 
                            @endif
                            
                            @if ($dashboard->warning_count['success']>0)
                            <span class="pull-left-container"><small class="label pull-left bg-green">{{$dashboard->warning_count['success']}}</small> </span> 
                            @endif
                            {!! $dashboard->title !!}</a></li>
                        @endforeach
                    </ul> 
        		
                </li>
                @endif

    		@endforeach




        <!-- URLs by folder -->
            <li class="header">URLs management</li>

                @foreach($folders as $folder)
                    @if ( count($folder->urls->pluck('title'))>0 )
                    <li class="treeview">
                        <a href="#"><i class='fa fa-folder'></i> <span>{!! $folder->name !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu"> 
                            @foreach($folder->urls as $url)         
                            <li><a href="/urlobject/{!! $url->id !!}"> <i class='fa fa-external-link'></i>{!! $url->title !!}</a></li>
                            @endforeach
                        </ul> 
                    </li>  
                    @endif
                @endforeach     


            <li class="header">CONFIGURATION  </li>

            <li><a href="/director"> <i class='fa fa-user'></i> <span> Directors </span> </a></li>
            <li><a href="/team"> <i class='fa fa-users'></i> <span> Teams </span> </a></li>
            <li><a href="/url"> <i class='fa fa-external-link'></i><span>  URLs</span> </a></li>
            <li><a href="/dashboard"> <i class='fa fa-dashboard'></i> <span> Dashboards </span> </a></li>
            <li><a href="/widgets"> <i class='fa fa-th'></i> <span> Widgets </span> </a></li>
            <li><a href="/datasources"> <i class='fa fa-cog'></i><span>DataSources</span></a></li>
            <li><a href="/connections"> <i class='fa fa-database'></i><span>Connections</span></a></li>
            

        </ul>

    </section>

</aside>

