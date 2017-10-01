// Add events to Filter Buttons
var searchForm = document.querySelector("#search_form");
var searchBtn = searchForm.querySelector('#searchBtn');
searchBtn.onclick = fnSubmitSearchForm.bind(this, searchBtn, searchForm);

// In case somebody decides to press 'ENTER'
searchForm.addEventListener("submit", function(e){
    e.preventDefault();
    // emulate search button click
    fnSubmitSearchForm({'id':'searchBtn'}, searchForm);
});

// SubmitSearchForm
function fnSubmitSearchForm(el, searchForm){
    var searchTerm = searchForm.querySelector("#searchTerm").value;

    //a hack for empty search
    if(searchTerm === '') {
        alert('You cannot search with an empty string!');
        return;
    }

    if(el.id == 'searchBtn') {
        self.location = '/search/' + searchTerm;
    }
}


var orderForm = document.querySelector("#order_form");
var orderByInput = orderForm.querySelector("#orderBy");

orderByInput.addEventListener('change', function(e){
    var hiddenInput = document.createElement('input');
    hiddenInput.name = 'returnUrl';
    hiddenInput.type = 'hidden';
    hiddenInput.value = window.location.pathname;
    orderForm.appendChild(hiddenInput);
    orderForm.submit();
});