const addRecordBtn = document.querySelector('#addRecordBtn');
const modalBg = document.querySelector('.modal-bg');
const modalCloseBtn = document.querySelector('.modalCloseBtn');

const editRecordBtn = document.querySelectorAll('.editModalBtn');
const editSubmitBtn = document.querySelectorAll('.editSubmitBtn');
const editModalBg = document.querySelector('.edit-modal-bg');
const editModalCloseBtn = document.querySelectorAll('.editModalCloseBtn');

const deleteRecordBtn = document.querySelectorAll('.deleteModalBtn');
const deleteRecordSubmitBtn = document.querySelectorAll('.deleteRecordSubmitBtn');
const deleteModalBg = document.querySelector('.delete-modal-bg');
const deleteModalCloseBtn = document.querySelectorAll('.deleteModalCloseBtn');
const deleteModalCancelBtn = document.querySelectorAll('.deleteModalCancelBtn');

const tableBody = document.getElementById('table-data');

addRecordBtn.addEventListener('click', () => {
  console.log('modal bg');
  modalBg.classList.add('modal-activate');
})

modalCloseBtn.addEventListener('click', () => {
  modalBg.classList.remove('modal-activate');
})

editRecordBtn.forEach(editBtn => {
  editBtn.addEventListener('click', () => {

    console.log('hello');
    const parentEl = editBtn.parentNode.parentNode;
    parentEl.id = 'active';

    const empId = parentEl.querySelector('.emp-id').innerText;
    const empLastName = parentEl.querySelector('.emp-lastname').innerText;
    const empFirstName = parentEl.querySelector('.emp-firstname').innerText;
    const empMiddleName = parentEl.querySelector('.emp-middlename').innerText;
    const empSexId = parentEl.querySelector('.emp-sexid').innerText;
    const empAddress = parentEl.querySelector('.emp-address').innerText;

    editModalBg.classList.add('modal-activate');

    console.log('emp_id:', editModalBg.querySelector('#edit_emp_id'));

    editModalBg.querySelector('#edit_last_name').value = empLastName;
    editModalBg.querySelector('#edit_first_name').value = empFirstName;
    editModalBg.querySelector('#edit_middle_name').value = empMiddleName;
    // editModalBg.querySelector('#edit_sexid').value = empSexId;

    if(empSexId == '1') {
      editModalBg.querySelector('#edit_male').checked = true;
    } else {
      editModalBg.querySelector('#edit_female').checked = true;
    }

    editModalBg.querySelector('#edit_address').value = empAddress;

    const datasetId = editBtn.dataset.empId;
    editModalBg.querySelector('.hiddenId').value = datasetId;
  })
})

editSubmitBtn.forEach(editSubmit => {
  
  editSubmit.addEventListener('click', (event) => {

    event.preventDefault();
    
    const parentEl = editSubmit.parentNode;
    const empId = parentEl.querySelector('.hiddenId').value;
    const empLastName = parentEl.querySelector('#edit_last_name').value;
    const empFirstName = parentEl.querySelector('#edit_first_name').value;
    const empMiddleName = parentEl.querySelector('#edit_middle_name').value;
    const empSexId = parentEl.querySelector('input[name="edit_sex"]:checked').value;
    const empAddress = parentEl.querySelector('#edit_address').value;

    axios.post('controller/update_record.php', {
      empId: empId,
      empLastName: empLastName,
      empFirstName: empFirstName,
      empMiddleName: empMiddleName,
      empSexId: empSexId,
      empAddress: empAddress,
    })
    .then(function (response) {

      const activeRow = document.getElementById('active');

      activeRow.querySelector('.emp-id').innerText = empId;
      activeRow.querySelector('.emp-lastname').innerText = empLastName;
      activeRow.querySelector('.emp-firstname').innerText = empFirstName;
      activeRow.querySelector('.emp-middlename').innerText = empMiddleName;
      activeRow.querySelector('.emp-sexid').innerText = empSexId;
      activeRow.querySelector('.emp-address').innerText = empAddress;

      document.getElementById('active').removeAttribute('id');      
      document.querySelector('.alert-update-success').classList.remove('hidden');

      setTimeout(() => {
        document.querySelector('.alert-update-success').classList.add('hidden');
      }, 3000)

      editModalBg.classList.remove('modal-activate');
    })
    .catch(function (error) {
      console.log(error);
    });
  })

})

editModalCloseBtn.forEach(editCloseBtn => {
  editCloseBtn.addEventListener('click', () => {
    editModalBg.classList.remove('modal-activate');
    document.getElementById('active').removeAttribute('id');
  })
})

deleteRecordBtn.forEach(deleteBtn => {
  deleteBtn.addEventListener('click', () => {
    deleteModalBg.classList.add('modal-activate');
    const parentEl = deleteBtn.parentNode.parentNode
    console.log('deleteBtn parentEl');
    console.log(parentEl);
    parentEl.id = 'active';
  })
})

deleteRecordSubmitBtn.forEach(deleteRecordSubmit => {
  deleteRecordSubmit.addEventListener('click', event => {

    event.preventDefault();

    const activeRow = document.getElementById('active');
    const empId = activeRow.querySelector('.emp-id').innerText;


    axios.post('controller/delete_record.php', {
      empId: empId
    })
    .then(response => {
      console.log(response);

      document.getElementById('active').removeAttribute('id');      
      document.querySelector('.alert-delete-success').classList.remove('hidden');
      tableBody.removeChild(activeRow);

      setTimeout(() => {
        document.querySelector('.alert-delete-success').classList.add('hidden');
      }, 3000)

      deleteModalBg.classList.remove('modal-activate');

    })
    .catch(error => {
      console.log(error);
    })
  })
})

deleteModalCloseBtn.forEach(deleteCloseBtn => {
  deleteCloseBtn.addEventListener('click', () => {
    deleteModalBg.classList.remove('modal-activate');
  })
})

deleteModalCancelBtn.forEach(deleteCancelBtn => {
  deleteCancelBtn.addEventListener('click', () => {
    deleteModalBg.classList.remove('modal-activate');
  })
})