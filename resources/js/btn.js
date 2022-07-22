let checks = document.querySelectorAll('.check_service')

for (let check of checks) {
    check.addEventListener('click', function(e) {
        let attributes = check.getAttributeNames();
        if (attributes.includes('checked')) {
            check.removeAttribute('checked')
        } else {
            check.setAttribute('checked', '')
        }
    })
}

let btn = document.querySelector('#btnCreate');

btn.addEventListener('click', function(e) {

    let checks = document.querySelectorAll('.check_service')
        //console.log(checks);

    let count = 0;
    for (let check of checks) {
        let attributes = check.getAttributeNames();
        //console.log(check.getAttributeNames());
        if (attributes.includes('checked')) {
            count++;
            //console.log(attributes);
        }
    }
    if (count === 0) {
        e.preventDefault();
        alert('Cazzo funziona')
    }
})