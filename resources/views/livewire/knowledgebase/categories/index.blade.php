<div>
   <div class="page-header ">


   <div class="row ">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">Kennisdatabase categories</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">
                <button wire:loading.attr="disabled" type="button" class="btn    btn-link btn-sm   btn-120" data-bs-toggle="modal"
                data-bs-target="#crudModal">
                Toevoegen
                </button> 
            </div>
        </div>
    </div>


    @include('livewire.knowledgebase.articles.search')



   <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 pt-3 " wire:loading.remove>
  
        @foreach($groups as $letter => $group)
        <div class="col mb-3 mb-lg-5">
         <div class="card h-80 card-hover">
            <div class = "card-header">{{ $letter }}</div>
     
 <div class  = "card-body p-2"><ul>
    @foreach($group as $category)



    <div class = "p-2 clear-fix border-bottom">
               <li class="list-inline-item d-inline-flex align-items-center">
                  <span class="legend-indicator bg-secondary"></span>
                  <a href = "/knowledgebase/categorie/{{$category->slug}}">  {{ $category['name'] }}
                  </a>
               </li>
            </div>


 

   

    @endforeach</ul>
    </div>
</div>
</div>

@endforeach

   </div> 

</div>


