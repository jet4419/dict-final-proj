const addRecordBtn = document.querySelector('#addRecordBtn');
const modalBg = document.querySelector('.modal-bg');
const modalCloseBtn = document.querySelector('.modalCloseBtn');

const editRecordBtn = document.querySelectorAll('.editModalBtn');
const editSubmitBtn = document.querySelectorAll('.editSubmitBtn');
const editModalBg = document.querySelector('.edit-modal-bg');
const editModalCloseBtn = document.querySelectorAll('.editModalCloseBtn');

const deleteRecordBtn = document.querySelectorAll('.deleteModalBtn');
const deleteModalBg = document.querySelector('.delete-modal-bg');
const deleteModalCloseBtn = document.querySelectorAll('.deleteModalCloseBtn');
const deleteModalCancelBtn = document.querySelectorAll('.deleteModalCancelBtn');

addRecordBtn.addEventListener('click', () => {
  console.log('modal bg');
  modalBg.classList.add('modal-activate');
})

modalCloseBtn.addEventListener('click', () => {
  modalBg.classList.remove('modal-activate');
})

editRecordBtn.forEach(editBtn => {
  editBtn.addEventListener('click', () => {
    console.log('modal bg');
    editModalBg.classList.add('modal-activate');
    const datasetId = editBtn.dataset.empId;
    editModalBg.querySelector('.hiddenId').value = datasetId;
  })
})

editSubmitBtn.forEach(editSubmit => {

  editSubmit.addEventListener('click', (event) => {

    const lastName = document.querySelector('.editLastName');
    // const firstName = document.querySelector('.editFirstName');

    event.preventDefault();

    const parentEl = editSubmit.parentNode;

    // console.log(parentEl);
    // parentEl.querySelector('.editFirstName').value = 'Okay';

    console.log(parentEl.querySelector('.editFirstName'));

    const empId = parentEl.querySelector('.hiddenId').value;

    console.log('employee ID:', empId);

    axios.get('getDataById.php', {
      params: {
        empId: empId
      }
    })
    .then(function (response) {
      const [data] = [response.data[0]];
      console.log(data);
      // lastName.value = {response }
    })
    .catch(function (error) {
      console.log(error);
    });

    // fetch('./php/getDataById', {
    //   method: 'POST',
    //   headers: {
    //     'Content-Type': 'application/json',
    //   },
    //   body: JSON.stringify({
    //     empId: empId
    //   }),
    // })
    // .then((response) => response.json())
    // .then((data) => {
    //   console.log('Success:', data);
    // })
    // .catch((error) => {
    //   console.error('Error:', error);
    // });
  })

})

// editSubmitBtn.addEventListener('click', () => {
//   console.log('hey');
  // const empId = 

  //   fetch('./php/getDataById', {
  //     method: 'POST',
  //     headers: {
  //       'Content-Type': 'application/json',
  //     },
  //     body: JSON.stringify(data),
  //   })
  //   .then((response) => response.json())
  //   .then((data) => {
  //     console.log('Success:', data);
  //   })
  //   .catch((error) => {
  //     console.error('Error:', error);
  //   });
// });

editModalCloseBtn.forEach(editCloseBtn => {
  editCloseBtn.addEventListener('click', () => {
    editModalBg.classList.remove('modal-activate');
  })
})

deleteRecordBtn.forEach(deleteBtn => {
  deleteBtn.addEventListener('click', () => {
    console.log('modal bg');
    deleteModalBg.classList.add('modal-activate');
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