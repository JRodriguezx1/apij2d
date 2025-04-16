(()=>{
    if(document.querySelector('.configcompañia')){
      
      //const miDialogoUpDireccion = document.querySelector('#miDialogoUpDireccion') as any;
      const selectDepartments = document.querySelector('#departamento') as HTMLSelectElement;
      const selectdCities = document.querySelector('#Ciudad') as HTMLSelectElement;
      //const btnCerrarUpDireccion = document.querySelector('#btnCerrarUpDireccion') as HTMLButtonElement;
      let indiceFila=0, control=0, tablaCompany:HTMLTableElement;
      
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
              Swal.fire(resultado.error[0], '', 'error')
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


      /////////////////////  Tabla de las compañias creadas ///////////////////////
      document.querySelector('#tablaCompany')?.addEventListener("click", (e)=>{ //evento click sobre toda la tabla
        const target = e.target as HTMLElement;
        if(target?.classList.contains("eliminarCompany")||target.parentElement?.classList.contains("eliminarCompany"))eliminarCompany(e);
      });
      
      
      function eliminarCompany(e:Event){
        let idCompany = (e.target as HTMLElement).parentElement!.id; //info = (tablaClientes as any).page.info();
        var tr = (e.target as HTMLElement).parentElement?.parentElement?.parentElement;
        if((e.target as HTMLElement).tagName === 'I'){
          idCompany = (e.target as HTMLElement).parentElement!.parentElement!.id;
          tr = (e.target as HTMLElement).parentElement?.parentElement?.parentElement?.parentElement;
        }
        //indiceFila = (tablaClientes as any).row((e.target as HTMLElement).closest('tr')).index();
        Swal.fire({
            customClass: {confirmButton: 'sweetbtnconfirm', cancelButton: 'sweetbtncancel'},
            icon: 'question',
            title: 'Desea eliminar la empresa?',
            text: "Se eliminara la empresa por completo.",
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
        }).then((result:any) => {
            if (result.isConfirmed) {
                (async ()=>{
                    try {
                        const url = "/admin/api/eliminarCompany?id="+idCompany; //llamado a la API REST y se trae las direcciones segun cliente elegido
                        const respuesta = await fetch(url); 
                        const resultado = await respuesta.json();
                        if(resultado.exito !== undefined){
                          //(tablaClientes as any).row(indiceFila+info.start).remove().draw(); 
                          //(tablaClientes as any).page(info.page).draw('page');
                          tr?.remove();
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
      }

    }
  
  })();