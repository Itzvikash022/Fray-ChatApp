const searchBar = document.querySelector(".users .search input"),
  searchBtn = document.querySelector(".users .search button"),
  userList = document.querySelector(".users .users-list");

searchBtn.onclick = () => {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
  searchBar.value = ""; 
};

searchBar.onkeyup = ()=> { //this function is called whenever the users releases a keystroke
  let searchTerm = searchBar.value;
  if(searchTerm != ""){
    searchBar.classList.add("active");
  } else{
    searchBar.classList.remove("active"); //adds and removes a active class in the searchbar element to check it status
  }
  let xhr = new XMLHttpRequest(); //XMl Object
  xhr.open("POST", "php/search.php", true);
  xhr.onload = () =>{
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        // console.log(data);
        userList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

setInterval(() => {
  let xhr = new XMLHttpRequest(); //XMl Object
  xhr.open("GET", "php/users.php", true);
  xhr.onload = () =>{
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        // console.log(data);
        if(!searchBar.classList.contains("active")){ //checks if the search bar is active, if yes then the setInterval will pause atm!
          userList.innerHTML = data;
        }
      }
    }
  }
  xhr.send();
}, 500); //this function will run frequently after 500ms
