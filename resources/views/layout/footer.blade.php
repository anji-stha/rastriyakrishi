   {{-- footer --}}
   <div class="footer mt-5">
       <div class="container">
           <div class="row">
               <div class="col-md-3">
                   <h5>राष्ट्रिय कृषि कम्पनी नेपाल लि.</h5>
                   <p>हामी नेपालको कृषि क्षेत्रको विकासमा समर्पित छौं।</p>
               </div>
               <div class="col-md-3">
                   <h5>सम्पर्क</h5>
                   <p>
                       <i class="fas fa-map-marker-alt"></i> काठमाडौं, नेपाल<br>
                       <i class="fas fa-phone"></i> +977-1-5970017<br>
                       <i class="fas fa-envelope"></i> info@rastriyakrishi.com.np
                   </p>
               </div>
               <div class="col-md-3">
                   <h5>Resources</h5>
                   <ul class="list-unstyled footer-links">
                       @foreach ($resources as $resource)
                           <li>
                               <a href="{{ $resource['url'] }}" target="_blank">{{ $resource['filename'] }}</a>
                           </li>
                       @endforeach
                   </ul>
               </div>
               <div class="col-md-3">
                   <h5>उपयोगी लिंकहरू</h5>
                   <ul class="list-unstyled footer-links">
                       <li><a href="#">गोपनीयता नीति</a></li>
                       <li><a href="#">सेवाका सर्तहरू</a></li>
                       <li><a href="#">रोजगारी</a></li>
                       <li><a href="#">सहायता केन्द्र</a></li>
                   </ul>
               </div>
           </div>
           <hr class="bg-light">
           <div class="text-center">
               <small>&copy;
                   <script>
                       document.write(new Date().getFullYear());
                   </script> राष्ट्रिय कृषि कम्पनी नेपाल लि. सर्वाधिकार सुरक्षित।
               </small>
           </div>
       </div>
   </div>
