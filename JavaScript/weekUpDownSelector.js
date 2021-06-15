$( ".down" ).click(function() {
    if(document.getElementById("weeks").selectedIndex > 0){
        let newIndex = document.getElementById("weeks").selectedIndex - 1;
        document.getElementById("weeks").selectedIndex = newIndex;
        document.getElementById("weeks").dispatchEvent(new Event('change'));
    }

});

$( ".up" ).click(function() {
    if(document.getElementById("weeks").selectedIndex < 53) {
        let newIndex = document.getElementById("weeks").selectedIndex + 1;
        document.getElementById("weeks").selectedIndex = newIndex;
        document.getElementById("weeks").dispatchEvent(new Event('change'));
    }
});
