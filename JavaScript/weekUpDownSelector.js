$( ".down" ).click(function() {
    if(document.getElementById("weeks").selectedIndex > 1){
        let newIndex = document.getElementById("weeks").selectedIndex - 1;
        document.getElementById("weeks").selectedIndex = newIndex;
    }

});

$( ".up" ).click(function() {
    let newIndex = document.getElementById("weeks").selectedIndex + 1;
    document.getElementById("weeks").selectedIndex = newIndex;
});