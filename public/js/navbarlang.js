
document.addEventListener('DOMContentLoaded', function(){
    const btn = document.getElementById("languageDropdownButton")
    document.querySelectorAll('#languageMenu .dropdown-item').forEach(function (item){
        item.addEventListener("click", function (){
            btn.innerHTML = this.getAttribute("data-lang")
        });
    });
});
