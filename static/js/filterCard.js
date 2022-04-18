/* Filter by choice */

function filterFunction(sel) {
    filt = sel.options[sel.selectedIndex].value;
    let cards = document.getElementsByClassName('card-filter')
    for (let i = 0, card; card = cards[i]; i++) {
        if (filt=="all"){
            card.classList.remove("is-hidden");
        } else {
            if (card.textContent.includes(filt)) {
                card.classList.remove("is-hidden");
            } else {
                card.classList.add("is-hidden");
            }
        }
    }
}

