    const sendHttpRequest = (method, url, data) => {
        const promise = new Promise((resolve, reject) => {
          const xhr = new XMLHttpRequest();
          xhr.open(method, url);
          xhr.responseType = 'json';
          
            xhr.onload = () => {
            if (xhr.status >= 400) {
              reject(xhr.response);
            } else {
              resolve(xhr.response);
            }           
          };
          
          xhr.onerror = () => {
            reject('Something went wrong')
          };
          xhr.send(data);        
        });
        return promise;        
    };
    const getMovies = () => {
      sendHttpRequest('GET', 'https://users.it.teithe.gr/~ait062021/index.php/v1/Movies')
      .then(responseData => {
        return responseData;
      })
    };    
    const postUser = () => {
      sendHttpRequest("POST", "https://users.it.teithe.gr/~ait062021/index.php/v1/Users",  
      '{"username" :"' + document.getElementById('user').value + '", "password" : "' + document.getElementById('pass').value + '"}'  
      ).then(requestData => {
        return requestData;
      }).catch(err => {
        return err;
      });
    };
    
    
    
    