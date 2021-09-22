{{-- feedback --}}

<section class="py-0">
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-12 justify-content-center">
                
                <h1 class="text-center">Feedbacks</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 feedback_data_class">
                <div class="feedback_class ">
                    {{-- <div class="feedback_data_class"> --}}
                        
                        @foreach($feedback_data as $feedback)
                        
                            <div class="card card-span text-white h-100">

                                <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                                    
                                    <h3 class="text-900 mt-3 ">
                                        <i class="fa fa-user text-secondary" style="font-size: 20px;"></i>
                                        {{$feedback->user->name}}
                                        @php
                                            $created_at = strtotime($feedback->created_at);
                                            $date = Carbon\Carbon::now()->diffForHumans($feedback->created_at);
                                           
                                        @endphp
                                        
                                    </h3>

                                    <span class="fw-normal text-900"> <i class="fas fa-clock me-2 text-secondary"></i>  {{$date}}  </span>
                                    
                                    <h5 class="text-900 mt-3">
                                        <blockquote> {{$feedback->message}} </blockquote>
                                    </h5>
                                    
                                </div>

                            </div>


                        

                        @endforeach
                    {{-- </div> --}}
                </div>
            </div>

            <div class="col-md-4">
                
                <h5 class="text-center">You can send us feedbacks</h5>
                <span class="text-danger">Maxlength is 100 letters</span>
                <textarea class="form-control feedback_text" minlength="10" maxlength="100" style="height: 120px;"></textarea>
                <div class="d-grid">
                    @if(Auth::user())
                    <button class="btn btn-secondary text-center mt-2 btn_feedback" type="button">
                        Send Us!
                    </button>
                    @else
                    <a href="/login" class=" btn btn-secondary form-control my-2">You are not Login!</a>
                    @endif
                </div>
                    
                
            </div>

        </div>
    </div>
   </div>
  </div>
 </div>
</section>
@push('script')
<script>

    //for trip and tour js
    $('.your-class').slick({
          autoplay: true,
          autoplaySpeed: 2000,
          centerMode: true,
          centerPadding: '60px',
          slidesToShow: 3,

          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
              }
            }
          ]
      });

    function  slickcarousel() {
          return {
              autoplay: true,
              autoplaySpeed: 2000,
              slidesToShow: 2,
          }
      }


 $('.feedback_class').slick(slickcarousel());


      $('.btn_feedback').click(function () {
          
          var feedback = $('.feedback_text').val();
          var html = "";
          var data = '';
          var current = new Date();
          var year = current.getFullYear();
          console.log(year);
          var month = current.getMonth()+1;
          var daysInMonth = new Date(year,month,1,-1).getDate();
          
           //console.log(daysInMonth);

          $.ajax({
                url : "/ajax_frontent_feedback",
                type : "POST",
                data : {feedback:feedback},
                success:function(data){
                    
                
                    $.each(data,function(i,v){
                        var diff = current - new Date(v.created_at);

                        var seconds = Math.floor(diff/1000); //ignore any left over units smaller than a second
                        var minutes = Math.floor(seconds/60); 
                        var second = seconds % 60;
                        console.log(second);
                        var hours = Math.floor(minutes/60);
                        var days = Math.floor(hours/24);
                        var months = days/month;
                        var year = months/12;

                        var hour_data = hours + ' hours after';
                        var minute_data = minutes + ' minutes after';
                        var second_data =  seconds + ' seconds after';

                        var day_data = days + ' days after';
                        var month_data = months + ' months after';
                        var year_data = year + ' year after';

                        if(seconds < 59){
                            data = second_data;

                        }else if (minutes <= 59) {

                            data = minute_data;

                        }else if (hours < 24) {
                            data = hour_data;
                        }else if (days < daysInMonth) {
                            data = day_data;
                        }else if (months < 12) {
                            data = month_data;
                        }else{
                             data = year_data;
                        }

                        
                html += `<div class="card card-span text-white h-100">

                            <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                                
                                <h3 class="text-900 mt-3 ">
                                    <i class="fa fa-user text-secondary" style="font-size: 20px;"></i>
                                    ${v.user.name}
                                    
                                    
                                </h3>

                                <span class="fw-normal text-900"> <i class="fas fa-clock me-2 text-secondary"></i>  ${data}  </span>
                                
                                <h5 class="text-900 mt-3">
                                    <blockquote> ${v.message}</blockquote>
                                </h5>
                                
                            </div>

                        </div>`

                    })
                    

                        $('.feedback_class').slick('unslick');

                        $('.feedback_class').html(html);
                        $(".feedback_class").not('.slick-initialized').slick(slickcarousel());

                    




                },
                error: function(err) {
                        console.log(err);
                    }
          })
      })



      

</script>
@endpush