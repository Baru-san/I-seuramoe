let dataSos = featureCollection


let availableKeywords = [];

dataSos.features.forEach(feature => {
    availableKeywords.push(feature.properties.name.Sample + ', ' + feature.properties.name.Desa + ', ' + feature.properties.name.Kec + ', ' + feature.properties.name.Kab);
    // availableKeywords.push(feature.properties);
   });

//    console.log(availableKeywords[0])


const resultBox = document.querySelector(".result-box");
const inputBox = document.getElementById("input-box");

inputBox.onkeyup = function(){
    let result = [];
    let input= inputBox.value;
    if(input.length){
        result = availableKeywords.filter((keyword)=>{
            return keyword.toLowerCase().includes(input.toLowerCase());
        });
        // console.log(result);
    }
    display(result);

    if(!result.length){
        resultBox.innerHTML = '';
    }
}

function display(result){
    
    const content = result.map((list)=>{
        return "<li onclick=selectInput(this)>" + list + "</li>";
    });



    resultBox.innerHTML = "<ul>" + content.join('') + "</ul>";
}

function selectInput(list){
    inputBox.value = list.innerHTML
    resultBox.innerHTML = '';
    
    let spot = inputBox.value.split(", ");
    let matchingFeature = dataSos.features.find(feature => {
        return feature.properties.name.Sample === spot[0];
    });

    coordinates = [matchingFeature.geometry.coordinates[1], matchingFeature.geometry.coordinates[0]];
    

    map.flyTo(coordinates, 19);
  
}