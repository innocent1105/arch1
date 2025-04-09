<style>
    .loading-box{
        transition-duration: 2s;
        /* animation: alternate loadingbox 5s; */
    }
    @keyframes loadingbox{
        0%{
            opacity: 1;
        }
        100%{
            opacity: 0;
        }
    }
    .logo-text{
        transition-duration: 0.5s;
        transition-timing-function: ease-in-out;
        transition-delay: 5s;
        animation:infinite logo 7s;
        overflow: hidden;
        position: absolute;
        z-index: 1;
    }
    .logo{
        margin-left: -50px;
        z-index: 2;
    }
    @keyframes logo{
        0%{
            opacity: 0;
            margin-left: -60px;
            color: black;
        }
        25%{
            opacity: 1;
            margin-left: -5px;
            color: white;
        }
        90%{
            opacity: 1;
            margin-left: -5px;
            color: white;
        }
        100%{
            opacity: 0;
            margin-left: -70px;
            color: black;
        }
    }
</style>

<div id="loading-tab" class="loading-box w-full h-screen box bg-black text-white p-4">
    <div class="main-logo flex justify-center">
        <div class="loading-content mt-72 flex gap-2 ">
            <div class="logo w-10 h-10 rounded-md bg-white "></div>
            <div class="logo-text text-white pt-1 text-xl">Realism</div>
        </div>
    </div> 
    <div class="loading-state text-gray-500 text-center animate-pulse pt-2 text-xs ">
        Loading...
    </div> 
</div>



<script>
    let loadingTab = document.getElementById("loading-tab");
    function stopLoading(){
        loadingTab.classList.add("animation", "alternate");
        loadingTab.style.animation = "alternate loadingbox 3s";
        setTimeout(()=>{
            loadingTab.style.display = "none";
        }, 1000); 
    }

    function startLoading(){
        loadingTab.style.display = "block";
    }

    
</script>






