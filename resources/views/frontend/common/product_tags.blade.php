@php
$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
$tags_ro = App\Models\Product::groupBy('product_tags_ro')->select('product_tags_ro')->get();
@endphp


<div class="sidebar-widget product-tag wow fadeInUp">
          <h3 class="section-title">
          @if(session()->get('language') == 'romanian') Taguri produse @else Product tags @endif
            </h3>
          <div class="sidebar-widget-body outer-top-xs')}}">
            <div class="tag-list"> 
            @if(session()->get('language') == 'romanian') 
                @foreach($tags_ro as $tag)
                <a class="item active" title="Phone" href="{{url('product/tag/'.$tag->product_tags_ro)}}">{{ str_replace(',',' ',$tag->product_tags_ro)}}</a> 
                @endforeach
            @else 
                @foreach($tags_en as $tag)
                <a class="item active" title="Phone" href="{{url('product/tag/'.$tag->product_tags_en)}}">{{str_replace(',',' ',$tag->product_tags_en)}}</a> 
                @endforeach
            @endif
            </div>
            <!-- /.tag-list --> 
          </div>
          <!-- /.sidebar-widget-body --> 
</div>