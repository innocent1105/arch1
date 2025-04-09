<div class="tabs">
    <div class="icons">
        <div id="messages-btn" class="icon"><i class="si-message"></i></div>
        <div id="models-btn" class="icon bg-gray-800"><i class="si-fullscreen"></i></div>
        <div id="user-acc-btn" class="icon"><i class="si-user-circle"></i></div>
    </div>
</div>



<script>
    let messagesBtn = document.getElementById("messages-btn");
    let modelsBtn = document.getElementById("models-btn");
    let userAccBtn = document.getElementById("user-acc-btn");


    messagesBtn.addEventListener("click", ()=>{
        window.location.href = "./messages.php";
    });

    modelsBtn.addEventListener("click", ()=>{
        window.location.href = "./model_view.php";
    });

    userAccBtn.addEventListener("click", ()=>{
        window.location.href = "./profile.php";
    });
</script>