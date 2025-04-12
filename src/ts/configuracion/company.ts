(()=>{
    if(document.querySelector('.configcompañia')){
      
      //const miDialogoUpDireccion = document.querySelector('#miDialogoUpDireccion') as any;
      const selectDepartments = document.querySelector('#departamento') as HTMLSelectElement;
      const selectdCities = document.querySelector('#Ciudad') as HTMLSelectElement;
      //const btnCerrarUpDireccion = document.querySelector('#btnCerrarUpDireccion') as HTMLButtonElement;
      let indiceFila=0, control=0, tablaClientes:HTMLElement;
      
      type municipalities = {
        id:string,
        department_id:string,
        name:string,
        code:string,
      };
      let cities:municipalities[]=[];

      selectDepartments.addEventListener('change', (e:Event)=>{
        const x:HTMLOptionElement = (e.target as HTMLOptionElement);
        imprimirCiudades(x.value);
      });
  

      function imprimirCiudades(x:string){ //actualizar o eliminar direccion
        (async ()=>{
          try {
            const url = "/admin/api/citiesXdepartments?id="+x; //llamado a la API REST y se trae las cities segun cliente elegido
            const respuesta = await fetch(url); 
            const resultado = await respuesta.json(); 
            if(resultado.error){
              console.log(110)
            }else{
              cities = resultado;
              addCitiesToSelect(cities);
            }
          } catch (error) {
              console.log(error);
          }
        })();
      }


       ////// añade direccion al select de cities al miDialogoUpDireccion, cuando se desea actualizar o eliminar la direccion de un cliente
      function addCitiesToSelect<T extends {id:string, department_id:string, name:string, code:string}>(addrs: T[]):void{
        while(selectdCities?.firstChild)selectdCities.removeChild(selectdCities?.firstChild);
        addrs.forEach(x =>{
          const option = document.createElement('option');
          option.textContent = x.name;
          option.value = x.id;
          option.dataset.code = x.code;
          option.dataset.department_id = x.department_id;
          selectdCities.appendChild(option);
        });
        
      }


      
      /*
      function eliminarClientes(e:Event){
        let idcliente = (e.target as HTMLElement).parentElement!.id, info = (tablaClientes as any).page.info();
        if((e.target as HTMLElement).tagName === 'I')idcliente = (e.target as HTMLElement).parentElement!.parentElement!.id;
        indiceFila = (tablaClientes as any).row((e.target as HTMLElement).closest('tr')).index();
        Swal.fire({
            customClass: {confirmButton: 'sweetbtnconfirm', cancelButton: 'sweetbtncancel'},
            icon: 'question',
            title: 'Desea eliminar el cliente?',
            text: "El cliente sera eliminado por completo.",
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
        }).then((result:any) => {
            if (result.isConfirmed) {
                (async ()=>{ 
                    const datos = new FormData();
                    datos.append('id', idcliente);
                    try {
                        const url = "/admin/api/eliminarCliente";
                        const respuesta = await fetch(url, {method: 'POST', body: datos}); 
                        const resultado = await respuesta.json();  
                        if(resultado.exito !== undefined){
                          (tablaClientes as any).row(indiceFila+info.start).remove().draw(); 
                          (tablaClientes as any).page(info.page).draw('page');
                          Swal.fire(resultado.exito[0], '', 'success') 
                        }else{
                            Swal.fire(resultado.error[0], '', 'error')
                        }
                    } catch (error) {
                        console.log(error);
                    }
                })();//cierre de async()
            }
        });
      }*/

    }
  
  })();