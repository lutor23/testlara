
	@if ($widget->infobox_type=='infobox')
	<!-- infobox simple -->
	<div id='infobox' class="col-md-{{$widget->size}}">
		<div class="info-box">
			<span class="info-box-icon bg-{{$widget->color}}"><i id="infobox_icon"  class="{{$widget->icon_class}}"></i></span>

			<div class="info-box-content">
          <span class="info-box-text form-widget-title">{{$widget->title}}</span>
          
          @if ( $widget->moreinfo_url == '' )
              <span class="info-box-number">{{ $widget->detail_value }} {{ $widget->units }}</span>
          @else
            <a href="{{$widget->moreinfo_url}}"  target="_blank">
              <span class="info-box-number">{{ $widget->detail_value }} {{ $widget->units }}</span>
            </a>
          @endif

          
			</div>
			<!-- /.info-box-content -->
		</div>
	</div>

	@elseif ($widget->infobox_type=='infobox_compare')
	<!-- infobox compare -->
	<div id='infobox_compare' class="col-md-{{$widget->size}}">
		<div class="info-box bg-{{$widget->color}}">
			<span class="info-box-icon"><i class="{{$widget->icon_class}}"></i></span>

			<div class="info-box-content">

				<span class="info-box-text form-widget-title">{{$widget->title}}</span>
				<span class="info-box-number">{{ $widget->detail_value }}</span>

				<div class="progress">
					<div class="progress-bar" style="width: 40%"></div>
				</div>
				<span class="progress-description">
					40% Increase in 30 Days
				</span>
			</div>
		</div>
	</div>

	@elseif ($widget->infobox_type=='infobox_moreinfo')
	<!-- infobox large moreinfo -->
	<div id='infobox_moreinfo' class="col-lg-{{$widget->size}} col-md-{{$widget->size}}">
		<div class="small-box bg-{{$widget->color}}">
			<div class="inner">
				<h3>{{ $widget->detail_value }}</h3>
				<p class="form-widget-title">{{$widget->title}}</p>
			</div>
			<div class="icon">
				<i class="{{$widget->icon_class}}"></i>
			</div>
			<a href="{{$widget->moreinfo_url}} " class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

    @elseif ($widget->infobox_type=='infoboxcounter')
	 <div id="infobox_counter" class="col-md-3">
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-aqua">
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username form-widget-title">{{ $widget->title }}</h3>
          </div>

          <div class="box-footer no-padding">
            <ul class="nav nav-stacked" id="infobox_counter_val">
              
              @foreach ( $widget->groupby_array as $widgetitem )
                <li><a href="/widgets/table/{{ $widget->id }}">{{ $widgetitem['field'] }} <span class="pull-right badge bg-blue"> {{ $widgetitem['fieldvalue'] }}</span></a></li>
              @endforeach

            </ul>
          </div>

        </div>
    </div>

  @elseif ($widget->infobox_type=='tablewidget')
  <div id="tablewidget" class="box col-md-12" > 
      <div class="box-header">
        <h3 class="box-title">{{$widget->title}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped dataTable">
          <thead>
            <tr>
              @foreach( $widget->json_array['headers'] as $jsonheader )
                  <th>{{ $jsonheader }}</th>
              @endforeach
            </tr>
          </thead>

          <tbody>
          @foreach($widget->json_array['content'] as $jsoncontent)
            <tr>
            @foreach($jsoncontent as $cell) 
              <td>{{ $cell }}</td>
            @endforeach
            </tr>
          @endforeach
          </tbody>
          <tfoot>
            <tr>
              @foreach( $widget->json_array['headers'] as $jsonheader )
                  <th>{{ $jsonheader }}</th>
              @endforeach         
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
      
    @elseif ($widget->infobox_type=='chart')

      <div id="chartwidget" class="col-lg-6 col-md-6" > 
         <div class="box">
<!--        <div class="box-header" style="text-align:center;" >
              <h3 class="box-title">{{$widget->title}}</h3>
            </div> -->
            
            {!! $widget->chartpreview()->render() !!}
          
          </div>
      </div>  


    @endif

