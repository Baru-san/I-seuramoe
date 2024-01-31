const userCardTemplate = document.querySelector("[data-user-template]")
const userCardContainer = document.querySelector("[data-user-cards-container]")
const searchInput = document.querySelector("[data-search]")

let users = []

searchInput.addEventListener("input", e => {
   const value = e.target.value;
   if (value === '') {
       users.forEach(user => {
           user.element.classList.add('hide');
       });
   } else {
       const visibleUsers = users.filter(user => user.name.includes(value) || user.email.includes(value));
       const limitedUsers = visibleUsers.slice(0, 5);
       users.forEach(user => {
           const isVisible = limitedUsers.includes(user);
           user.element.classList.toggle("hide", !isVisible);
       });
   }
});


fetch("/fetchdata")
   .then(res => res.json())
   .then(data => {
       users = data.map(user => {
           // Parse the data and geometry fields
           const dataObj = JSON.parse(user.data);
           const geometryObj = JSON.parse(user.geometry);

           // Extract the Sample and Desa fields
           const sample = dataObj.Sample;
           const desa = dataObj.Desa;

           const card = userCardTemplate.content.cloneNode(true).children[0];
        //    card.classList.add('card-item');
           card.classList.add('hide');
           const header = card.querySelector("[data-header]");
           const body = card.querySelector("[data-body]");
           card.classList.add('hide');

           header.textContent = sample
           body.textContent = desa
           userCardContainer.append(card)
           return { name: sample, email: desa, element: card}
       })
   })

