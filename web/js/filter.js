function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById("filterinput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("filter");
    li = ul.getElementsByTagName("li");

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        p = li[i].getElementsByTagName("p")[0];
        if (p.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}