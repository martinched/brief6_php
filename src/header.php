<header class="flex flex-col justify-center items-center">

        <h1 class="text-3xl font-bold text-blue-900 flex font-roboto m-4 text-center">
                Gestionnaire de favoris
        </h1>
           <div class=" flex justify-center">
                <a href="index.php"> 
                     <button class="fas fa-home bg-blue-400 hover:bg-blue-900 text-white px-4 py-2 rounded h-10 
                                    m-4 border p-4 border-gray-300 shadow-lg ">
                      </button> 
                </a>
                <form action="create.php" method="get" class="flex items-center content-center  mb-0" >    
                      <button class="font-bold bg-blue-400 hover:bg-blue-900
                                text-white px-4 py-2 rounded h-10 border border-gray-300 shadow-lg"
                                >Ajouter
                      </button>
                </form>
                <button onclick="toggleFilter()" class="fas fa-search bg-blue-400 text-white px-4 py-2 
                                rounded h-10 m-4 ml-10 border p-4 border-gray-300 shadow-lg">
                </button>
           </div>
</header>