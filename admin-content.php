<section class="assignments" id="stats">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Statistik</h5>
        <?php
         include('includes/stats/stats.php');
         ?>
       </div>
       <div class="card-body">
         <div id="coords">
           <h5 class="card-title">Position</h5>
           <div class="input-group mb-3">
             <div class="input-group-prepend">
               <button class="btn btn-secondary" type="button" id="generateCoords">Start</button>
             </div>
             <label for="generateCoords" class="sr-only">Find koordinater</label>
             <input id="geo" type="text" class="form-control" placeholder="Find koordinater" aria-label="Get coordiantes">
           </div>
         </div>
       </div>
       <div class="card-body"><
         h5 class="card-title">Dev stats for dette website</h5>
         <div id="gitHubStats"></div>
       </div>
     </div>
   </div>
 </section>
