$(document).ready(function () {

    var contractFrankTemplateEdit = kendo.template($("#tmpPrint").html());
    var printWindowFrankEdit = $("#printContractFrankWindow").data("kendoWindow");

  kendo.culture('pl-PL')

  if (getCookie('contractList')) {
    switchTabToContractList()
    deleteCookie('contractList')
  }

  var agentNumber = user
  var contractID
  var windowEdit
  var dataSource = new kendo.data.DataSource({
    transport: {
      read: {
        url: API_URL + 'frank/getcontractlist/' + agentNumber,
        dataType: 'json',
      },
      update: {
        url: API_URL + 'frank/editcontract/' + agentNumber + contractID,
        type: 'post',
        dataType: 'json',
      },
    },
    pageSize: 12,
  })

  $('#grid').kendoGrid({
    dataSource: dataSource,
    // height: 250,
    groupable: true,
    sortable: true,
    pageable: {
      refresh: true,
      pageSizes: true,
      buttonCount: 5,
    },
    detailTemplate: kendo.template($("#detailTemplate").html()),
    /*dataBound: function(){
      var grid = this;
      this.tbody.find('tr').each(function(){
        var item = grid.dataItem($(this));
        if( item.sentToCentral == '1') {
          $(this).find('.k-grid-edit').hide();
        }
      });
    },*/
    detailInit: function (e) {
      e. preventDefault();
      var self = this;
      var detailRow = e.detailRow;
      if (e.data.sentToCentral != '0') {
        $(detailRow[0].children[1].children[0].children[0].children[0]).empty();
        $(detailRow[0].children[1].children[0].children[0].children[0]).append('<p>Sprawa została wysłana do centrali</p>');
        $(detailRow[0].children[1].children[0].children[1].children[0].children[0]).removeClass('hide');
      } else {
        //Dodawanie contractId do atrybutu id przycisku "Wyślij dane do centrali"
        detailRow[0].children[1].children[0].children[0].children[0].children[0].setAttribute('id', e.data.ContarctID);

        $(".sendToCentral", "#grid").bind("click", function (e) {
          $.ajax({
            url: API_URL + 'frank/sendto' +
            'central',
            type: 'POST',
            dataType: 'json',
            data: {
              contractId: $(this).attr('id')
            }
          }).success(function (data) {
            $(detailRow[0].children[1].children[0].children[0].children[0]).empty();
            $(detailRow[0].children[1].children[0].children[0].children[0]).append('<p>Sprawa została wysłana do centrali</p>');
            $(detailRow[0].children[1].children[0].children[1].children[0].children[0]).removeClass('hide');
            self.dataSource.read();
          }).error(function (error) {
            $(detailRow[0].children[1].children[0].children[0].children[0]).empty();
            $(detailRow[0].children[1].children[0].children[0].children[0]).append('<p style="color: red">Wystąpił błąd podczas wysyłania sprawy</p>');
          });
        });
      }
      $(".addFilesBtn", "#grid").bind("click", function () {
        if($(detailRow[0].children[1].children[0].children[1].children[1]).hasClass('hide')) {
          $(detailRow[0].children[1].children[0].children[1].children[1]).removeClass('hide');
          if (!($('#file_type_' + e.data.ContarctID).attr('id'))) {
            $(detailRow[0].children[1].children[0].children[1].children[1].children[1].children[0]).addClass('file_type_' + e.data.ContarctID);
            $(detailRow[0].children[1].children[0].children[1].children[1].children[1].children[0]).attr('id', 'file_type_' + e.data.ContarctID);
          }

          $(".file_type_" + e.data.ContarctID).kendoComboBox({
            placeholder: "Wybierz:",
            dataTextField: "name",
            dataValueField: "id",
            autoBind: false,
            dataSource: {
              transport: {
                read: {
                  url: API_URL + 'contract/getdictionary',
                  cache: "false"
                }
              }
            },
            value: "Wybierz typ:",
            select: function () {
              e.preventDefault();
              $('.sendFilesToCentral').removeClass('hide');
              $('.fileUploadDiv > .sendFilesToCentral > input').addClass('files_' + e.data.ContarctID);
              $('.files_' + e.data.ContarctID).css('display', 'block');

              $('.files_' + e.data.ContarctID).kendoUpload({
                async: {
                  withCredentials: false,
                  saveUrl: API_URL + 'frank/upload',
                  autoUpload: false
                },
                uploadEventHandler (e) {
                  e.headers.set('Access-Control-Allow-Credentials', 'true');
                  //e.headers.append('Authorization', 'Bearer ' + abp.auth.getToken());
                },
                type: "post",
                success: function () {
                  console.log('ok');
                  $("#grid").data("kendoGrid").refresh();
                },
                upload: function (d) {
                  console.log(d.data);
                  d.data = {
                    fileType: $("#file_type_" + e.data.ContarctID).data("kendoComboBox").value()
                  };
                  console.log(d.data);
                },
                showFileList: true,
              });
            },
          });
        }
      });

    },
    detailExpand: function(e) {
          var grid = e.sender;
          var rows = grid.element.find(".k-master-row").not(e.masterRow);

          rows.each(function(e) {
            grid.collapseRow(this);
      });
      grid.expandRow(e.masterRow);
    },
    filterable: {
      extra: false,
      operators: {
        string: {
          contains: 'Zawiera',
          startswith: 'Zaczyna się od',
          eq: 'Jest równe',
          neq: 'Nie jest równe',
        },
      },
    },
    columns: [
      {
        field: 'ContarctID',
        title: 'ID',
      },
      {
        field: 'FirstName',
        title: 'Imię',
      },
      {
        field: 'LastName',
        title: 'Nazwisko',
      },
      {
        field: 'AddDate',
        title: 'Data dodania',
      },
        {
            command: [
                {
                    text: "Edytuj",
                    name: "edit",
                    iconClass: "k-icon k-i-edit",
                    className: "btn-edit",
                    width: 100,
                    visible: function(dataItem) {
                        return dataItem.sentToCentral==="0" ;
                    }
                }
            ], width: '100px',
        },,
    ],
    editable: {
      mode: 'popup',
      window: {
        title: 'Edycja Umowy',
        animation: false,
        position: {
          top: 10,
          left: '5%',
        },
      },
      template: $('#popup_editor').html(),
    },
    edit: function (e) {
      var model = e.model
      contarctID = model.ContarctID
      $('a.k-grid-update').hide()
      $('a.k-grid-cancel').hide()


      $('#print-edit').kendoButton({
        click: function (e) {
          openWindowEdit2()
        },
      })


            function openWindowEdit2 () {

                $.ajax({
                    url: API_URL + 'frank/bankcontractget/' + contarctID,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        printWindowFrankEdit.content(contractFrankTemplateEdit(data));
                    }
                });
                printWindowFrankEdit.open();

                printWindowFrankEdit.element.prev().find(".k-window-title").html("Umowa Frankowa nr " + contarctID);
            }

            $(e.container).parent().css({
                width: '70%',
                height: '100%',
                top: 50,
                left: "15%"
            })


            $('#contract-edit').kendoTabStrip({
                animation: {
                    open: {
                        effects: 'fadeIn',
                    },
                },
                select: onSelect,
            })

            function onSelect (e) {
                setTimeout(function () { $('.tab-contract').css('height', 'auto') },
                    300)
            }
      $('#contract-edit').kendoTabStrip({
        animation: {
          open: {
            effects: 'fadeIn',
          },
        },
        select: onSelect,
      })

      function onSelect (e) {
        setTimeout(function () { $('.tab-contract').css('height', 'auto') },
          300)
      }

            $('#clear-data-edit').on('click', function (event) {
                $('#contract-edit').find('input').val('')
            })

            $('#copy-address-edit').on('click', function (event) {
                // event.preventDefault()
                $('#StreetIIEdit').val($('#StreetIEdit').val())
                $('#HomeNumberIIEdit').val($('#HomeNumberIEdit').val())
                $('#ApartmentNumberIIEdit').val($('#ApartmentNumberIEdit').val())
                $('#PostCodeIIEdit').val($('#PostCodeIEdit').val())
                $('#CityIIEdit').val($('#CityIEdit').val())
            })

            $('#Button3aEdit').on('click', function () {
                $('.other-agent-edit').removeClass('hide')
            })

            $('#Button3bEdit').on('click', function () {
                $('.other-agent-edit').addClass('hide')
            })

            $('#FirstNameIIEdit').on('change', function () {
                if ($('#FirstNameIIEdit').val()) {
                    this.setAttribute('required', true)
                    this.setAttribute('validationMessage', 'To pole jest wymagane.')
                    this.parentNode.className = 'contract-1'
                    $('#LastNameIIEdit').attr('required', 'true')
                    $('#LastNameIIEdit').
                    attr('validationMessage', 'To pole jest wymagane.')
                    $('#LastNameIIEdit').parent().addClass('contract-1')
                    $('#PESELIIEdit').attr('required', 'true')
                    $('#PESELIIEdit').attr('validationMessage', 'To pole jest wymagane.')
                    $('#PESELIIEdit').parent().addClass('contract-1')
                    $('#IdentityCardIIEdit').attr('required', 'true')
                    $('#IdentityCardIIEdit').
                    attr('validationMessage', 'To pole jest wymagane.')
                    $('#IdentityCardIIEdit').parent().addClass('contract-1')
                }
            })

            var tabStrip = $('#contract-edit').kendoTabStrip().data('kendoTabStrip')

      $('#contract-edit').on('click', '.nextTab1 ', function (event) {
        // event.preventDefault()
        var validator = false
        $('.contract-1-edit').each(function () {
          var validator1 = $(this).kendoValidator().data('kendoValidator')
          validator = validator1.validate()
          if (validator === false) {
            var errors = validator1.errors()
            $(errors).each(function () {
              var m = this
              console.log(this)
            })
            return false
          }
        })
        if (validator) {
          tabStrip.select(1)
        }
      })

      $('#contract-edit').on('click', '.nextTab2', function () {
        // event.preventDefault()
        var validator = false
        $('.contract-2-edit').each(function () {
          var validator1 = $(this).kendoValidator().data('kendoValidator')
          validator = validator1.validate()
          if (validator == false) return false
        })
        if (validator) {
          tabStrip.select(2)
        }
      })

      $('#contract-edit').on('click', '.nextTab3', function () {
        tabStrip.select(3)
      })

      $('#contract-edit').on('click', '.nextTab4', function () {
        tabStrip.select(4)
      })
      $('#contract-edit').on('click', '.nextTab5', function () {
        tabStrip.select(5)
      })

      function generatePDF (selector) {
        kendo.drawing.drawDOM(selector, {
          forcePageBreak: '.new-page',
          paperSize: 'A4',
          margin: '0cm',
          scale: 0.5,
        }).then(function (group) {
          kendo.drawing.pdf.saveAs(group, 'contract.pdf')
        })
      }

      $('#OtherAgentDateEdit').kendoDatePicker({})
      $('#CheckBox1DateEdit').kendoDatePicker({})
      $('#CheckBox2DateEdit').kendoDatePicker({})
      $('#CheckBox3DateEdit').kendoDatePicker({})

      $.ajax({
        url: API_URL + 'frank/bankcontractget/' + contarctID,
        type: 'GET',
        dataType: 'json',
      }).done(function (data) {
        $('input[name="FirstNameIEdit"]').val(data.FirstName1)
        $('input[name="LastNameIEdit"]').val(data.LastName1)
        $('input[name="StreetIEdit"]').val(data.Street1)
        $('input[name="HomeNumberIEdit"]').val(data.Home1)
        $('input[name="ApartmentNumberIEdit"]').val(data.Apartment1)
        $('input[name="PostCodeIEdit"]').val(data.PostCode1)
        $('input[name="CityIEdit"]').val(data.City1)
        $('input[name="PESELIEdit"]').val(data.PESEL1)
        $('input[name="IdentityCardIEdit"]').val(data.IdNr1)
        $('input[name="PhoneIEdit"]').val(data.Phone1)
        $('input[name="EmailIEdit"]').val(data.Email1)

        $('input[name="FirstNameIIEdit"]').val(data.FirstName2)
        $('input[name="LastNameIIEdit"]').val(data.LastName2)
        $('input[name="StreetIIEdit"]').val(data.Street2)
        $('input[name="HomeNumberIIEdit"]').val(data.Home2)
        $('input[name="ApartmentNumberIIEdit"]').val(data.Apartment2)
        $('input[name="PostCodeIIEdit"]').val(data.PostCode2)
        $('input[name="CityIIEdit"]').val(data.City2)
        $('input[name="PESELIIEdit"]').val(data.PESEL2)
        $('input[name="IdentityCardIIEdit"]').val(data.IdNr2)
        $('input[name="PhoneIIEdit"]').val(data.Phone2)
        $('input[name="EmailIIEdit"]').val(data.Email2)

        $('input[name="StreetEdit"]').val(data.ForrwardingStreet)
        $('input[name="HomeNumberEdit"]').val(data.ForrwardingHome)
        $('input[name="ApartmentNumberEdit"]').val(data.ForrwardingApartment)
        $('input[name="PostCodeEdit"]').val(data.ForrwardingPostalCode)
        $('input[name="MandateBankNameEdit"]').val(data.MandateBankName)
        $('input[name="BankNameEdit"]').val(data.BankName)
        $('input[name="CityEdit"]').val(data.ForrwardingCity)
        $('input[name="CreditTypeEdit"]').val(data.CreditType)
        $('input[name="ContractTypeEdit"]').val(data.ContractName)

        setDateDatePicker(data.CheckBox1Date, 'CheckBox1DateEdit')
        setDateDatePicker(data.CheckBox2Date, 'CheckBox2DateEdit')
        setDateDatePicker(data.CheckBox3Date, 'CheckBox3DateEdit')

        $('input[name="ContractNumberEdit"]').val(data.BankContractNumber)
        setCheckRadio('RadioButton1Edit', data.RadioButton1)
        setCheckRadio('RadioButton2Edit', data.RadioButton2)
        setCheckRadio('RadioButton3Edit', data.RadioButton3)
        $('input[name="OtherAgentNameEdit"]').val(data.OtherAgentName)
        $('input[name="OtherAgentDateEdit"]').val(data.OtherAgentDate)
        setCheckBox('CheckBox1Edit', data.CheckBox1)
        setCheckBox('CheckBox2Edit', data.CheckBox2)
        setCheckBox('CheckBox3Edit', data.CheckBox3)
        $('input[name="CheckBox1DateEdit"]').val(data.CheckBox1Date)
        $('input[name="CheckBox2DateEdit"]').val(data.CheckBox2Date)
        $('input[name="CheckBox3DateEdit"]').val(data.CheckBox3Date)

        setCheckBox('dataConsentDSAEdit', data.dataConsentDSA)
        setCheckBox('dataConsentPCRFEdit', data.dataConsentPCRF)
        setCheckBox('dataConsentVOTUMEdit', data.dataConsentVOTUM)
        setCheckBox('dataConsentAUTOVOTUMEdit', data.dataConsentAUTOVOTUM)
        setCheckBox('dataConsentBEPEdit', data.dataConsentBEP)
        setCheckBox('marketingConsentDSA1Edit', data.marketingConsentDSA1)
        setCheckBox('marketingConsentDSA2Edit', data.marketingConsentDSA2)
        setCheckBox('marketingConsentVOTUM1Edit', data.marketingConsentVOTUM1)
        setCheckBox('marketingConsentVOTUM2Edit', data.marketingConsentVOTUM2)
        $('#BankContractDateEdit').kendoDatePicker({})
        $('#unit-edit').kendoDropDownList({
          filter: "contains",
          dataTextField: 'unitNumber',
          dataValueField: 'unitID',
          dataSource: {
            transport: {
              read: {
                url: API_URL + 'frank/getunit',
              }
            }
          },
        })
        $('#consultant-edit').kendoDropDownList({
          filter: "contains",
          dataTextField: 'consultantNumber',
          dataValueField: 'consultantID',
          dataSource: {
            transport: {
              read: {
                url: API_URL + 'frank/getconsultantnumber',
              }
            }
          },
        })
        $('input[name="BankContractDateEdit"]').val(data.BankContractDate)
       // $('#unit-edit').val(data.unit_id)
         var unitDropdownlist =$('#unit-edit').data("kendoDropDownList")
         var consultantDropdownlist =$('#consultant-edit').data("kendoDropDownList")
         var bankDateDatePicker =$('#BankContractDateEdit').data("kendoDatePicker")
       //  dropdownlist1.select(parseInt(data.unit_id));
       //  $('#consultant-edit').data("kendoDropDownList").select(parseInt(data.consultant_id))
        unitDropdownlist.value(parseInt(data.unit_id))
        consultantDropdownlist.value(parseInt(data.consultant_id))
        bankDateDatePicker.value(data.BankContractDate)


        setCheckRadio('RadioCustomerEdit', data.RadioCustomer)
        $('input[name="AccountNumberEdit"]').val(data.CustomerAccountNumber)
        $('input[name="CustomerFirstNameEdit"]').val(data.CustomerFirstname)
        $('input[name="CustomerLastNameEdit"]').val(data.CustomerLastname)
        $('input[name="CustomerStreetEdit"]').val(data.CustomerStreet)
        $('input[name="CustomerHomeNumberEdit"]').val(data.CustomerStreetNumber)
        $('input[name="CustomerApartmentNumberEdit"]').val(data.CustomerApartmentNumber)
        $('input[name="CustomerPostCodeEdit"]').val(data.CustomerPostalCode)
        $('input[name="CustomerCityEdit"]').val(data.CustomerCity)

        addOtherAgentFields(data.other_agent_name, data.other_agent_date)
      })

      $('.contract-edit-field').one('change keyup', function () {
            $('#print-edit').addClass('hide')
            $('#update-edit').removeClass('hide')
      })

      $('#update-edit').on('click', function () {

        var validatorEdit1 = false
        $('.contract-1-edit').each(function () {
          var validator1 = $(this).kendoValidator().data('kendoValidator')
          validatorEdit1 = validator1.validate()
          if (validatorEdit1 == false) {
            tabStrip.select(0)
            return false
          }
        })

        $('.contract-3-edit').each(function () {
          var validator1 = $(this).kendoValidator().data('kendoValidator')
          validatorEdit3 = validator1.validate()
          if (validatorEdit3 == false) {
            tabStrip.select(4)
            return false
          }
        })
        if (!((validatorEdit1 === false) || (validatorEdit3 === false))) {
          $.ajax({
            url: API_URL + 'frank/updatecontract',
            type: 'POST',
            dataType: 'json',
            data: {
              'AgentNumber1': 'user',
              'AgentNumber': user,
              'ContractID': contarctID,
              'FirstNameI': document.getElementsByName(
                'FirstNameIEdit')[0].value,
              'LastNameI': document.getElementsByName('LastNameIEdit')[0].value,
              'StreetI': document.getElementsByName('StreetIEdit')[0].value,
              'HomeNumberI': document.getElementsByName(
                'HomeNumberIEdit')[0].value,
              'ApartmentNumberI': document.getElementsByName(
                'ApartmentNumberIEdit')[0].value,
              'PostCodeI': document.getElementsByName('PostCodeIEdit')[0].value,
              'CityI': document.getElementsByName('CityIEdit')[0].value,
              'PESELI': document.getElementsByName('PESELIEdit')[0].value,
              'IdentityCardI': document.getElementsByName(
                'IdentityCardIEdit')[0].value,
              'PhoneI': document.getElementsByName('PhoneIEdit')[0].value,
              'EmailI': document.getElementsByName('EmailIEdit')[0].value,

              'FirstNameII': document.getElementsByName(
                'FirstNameIIEdit')[0].value,
              'LastNameII': document.getElementsByName(
                'LastNameIIEdit')[0].value,
              'StreetII': document.getElementsByName('StreetIIEdit')[0].value,
              'HomeNumberII': document.getElementsByName(
                'HomeNumberIIEdit')[0].value,
              'ApartmentNumberII': document.getElementsByName(
                'ApartmentNumberIIEdit')[0].value,
              'PostCodeII': document.getElementsByName(
                'PostCodeIIEdit')[0].value,
              'CityII': document.getElementsByName('CityIIEdit')[0].value,
              'PESELII': document.getElementsByName('PESELIIEdit')[0].value,
              'IdentityCardII': document.getElementsByName(
                'IdentityCardIIEdit')[0].value,
              'PhoneII': document.getElementsByName('PhoneIIEdit')[0].value,
              'EmailII': document.getElementsByName('EmailIIEdit')[0].value,
              'Street': document.getElementsByName('StreetEdit')[0].value,
              'HomeNumber': document.getElementsByName(
                'HomeNumberEdit')[0].value,
              'ApartmentNumber': document.getElementsByName(
                'ApartmentNumberEdit')[0].value,
              'PostCode': document.getElementsByName('PostCodeEdit')[0].value,
              'City': document.getElementsByName('CityEdit')[0].value,

              'BankName': document.getElementsByName('BankNameEdit')[0].value,

              'ContractNumber': document.getElementsByName(
                'ContractNumberEdit')[0].value,
              'RadioButton1': getCheckedRadio('RadioButton1Edit'),
              'RadioButton2': getCheckedRadio('RadioButton2Edit'),
              'RadioButton3': getCheckedRadio('RadioButton3Edit'),

              'OtherAgentName': checkOtherAgentCheckbox(
                document.getElementsByName('OtherAgentNameEdit')[0].value),
              'OtherAgentDate': checkOtherAgentCheckbox(
                document.getElementsByName('OtherAgentDateEdit')[0].value),

              'CheckBox1': getCheckedCheckbox('CheckBox1Edit'),
              'CheckBox2': getCheckedCheckbox('CheckBox2Edit'),
              'CheckBox3': getCheckedCheckbox('CheckBox3Edit'),
              'CheckBox1Date': document.getElementsByName(
                'CheckBox1DateEdit')[0].value,
              'CheckBox2Date': document.getElementsByName(
                'CheckBox2DateEdit')[0].value,
              'CheckBox3Date': document.getElementsByName(
                'CheckBox3DateEdit')[0].value,

              'CreditType': document.getElementsByName(
                'CreditTypeEdit')[0].value,
              'MandateBankName': document.getElementsByName(
                'MandateBankNameEdit')[0].value,

              'dataConsentDSA': getCheckedCheckbox('dataConsentDSAEdit'),
              'dataConsentPCRF': getCheckedCheckbox('dataConsentPCRFEdit'),
              'dataConsentVOTUM': getCheckedCheckbox('dataConsentVOTUMEdit'),
              'dataConsentAUTOVOTUM': getCheckedCheckbox(
                'dataConsentAUTOVOTUMEdit'),
              'dataConsentBEP': getCheckedCheckbox('dataConsentBEPEdit'),
              'marketingConsentDSA1': getCheckedCheckbox(
                'marketingConsentDSA1Edit'),
              'marketingConsentDSA2': getCheckedCheckbox(
                'marketingConsentDSA2Edit'),
              'marketingConsentVOTUM1': getCheckedCheckbox(
                'marketingConsentVOTUM1Edit'),
              'marketingConsentVOTUM2': getCheckedCheckbox(
                'marketingConsentVOTUM2Edit'),

              'BankContractDate': document.getElementsByName(
                'BankContractDateEdit')[0].value,
              'Unit': document.getElementsByName(
                'UnitEdit')[0].value,

              'UnitNumber': $("#unit-edit").data("kendoDropDownList").text() == 'Brak' ? ' ' : $("#unit-edit").data("kendoDropDownList").text(),
              'Consultant': document.getElementsByName(
                'ConsultantEdit')[0].value,
              'ConsultantNumber': $("#consultant-edit").data("kendoDropDownList").text() == 'Brak' ? ' ' : $("#consultant-edit").data("kendoDropDownList").text(),


              'RadioCustomer': getCheckedRadio('RadioCustomerEdit'),
              'AccountNumber': document.getElementsByName(
                'AccountNumberEdit')[0].value,
              'CustomerFirstName': document.getElementsByName(
                'CustomerFirstNameEdit')[0].value,
              'CustomerLastName': document.getElementsByName(
                'CustomerLastNameEdit')[0].value,
              'CustomerStreet': document.getElementsByName(
                'CustomerStreetEdit')[0].value,
              'CustomerHomeNumber': document.getElementsByName(
                'CustomerHomeNumberEdit')[0].value,
              'CustomerApartmentNumber': document.getElementsByName(
                'CustomerApartmentNumberEdit')[0].value,
              'CustomerPostCode': document.getElementsByName(
                'CustomerPostCodeEdit')[0].value,
              'CustomerCity': document.getElementsByName(
                'CustomerCityEdit')[0].value,
              'ContractType': document.getElementsByName(
                'ContractTypeEdit')[0].value,
            },
          }).success(function (ContractID) {
            $('#contract-edit').data('contract_id_edit')
            $('#contract-edit').attr('data-contract_id_edit', ContractID)
            $('#update-edit').attr('disabled', 'disabled')
            $('#print-edit').removeClass('hide')
          })
        }
      })
    },
  })



  function setCheckRadio (radioName, value) {
    $('input[name=' + radioName + '][value=' + value + ']').
      prop('checked', true)
  }

  function setCheckBox (checkboxName, value) {
    if (value === '1') {
      $('input[name=' + checkboxName + ']').prop('checked', true)
    }
  }

  function setDateDatePicker (date, id) {
    var datepicker = $('#' + id).data('kendoDatePicker')
    datepicker.value(date)
  }

  function addOtherAgentFields (agentName, agentDate) {
    if (agentName) {
      $('.other-agent-edit').removeClass('hide')
      $('input[name="OtherAgentNameEdit"]').val(agentName)
      $('input[name="OtherAgentDateEdit"]').val(agentDate)
      return true
    } else {
      $('.other-agent-edit').addClass('hide')
      return false
    }
  }

  function getCheckedRadio (name) {
    var radioButtons = document.getElementsByName(name)
    for (var x = 0; x < radioButtons.length; x++) {
      if (radioButtons[x].checked) {
        return radioButtons[x].value
      }
    }
  }

  function getCheckedCheckbox (name) {
    if (document.getElementsByName(name)[0].checked) {
      return '1'
    }
    else return '0'
  }

  function checkOtherAgentCheckbox (name) {
    if ($('.other-agent-edit').hasClass('hide')) {
      return null
    } else {
      return name
    }
  }

  function onClose () {
    location.reload()
    setCookie('contractList', true)
  }

  function switchTabToContractList () {
    $('#v-pills-franc-calculator').removeClass('active')
    $('#v-pills-franc-calculator').removeClass('show')
    $('#v-pills-franc-calculator-tab').removeClass('active')
    $('#v-pills-franc-calculator-tab').attr('aria-selected', 'false')
    $('#v-pills-contract_list').addClass('active')
    $('#v-pills-contract_list').addClass('show')
    $('#v-pills-contract_list-tab').addClass('active')
    $('#v-pills-contract_list-tab').attr('aria-selected', 'true')
  }

    function openWindowEdit () {
        var contract_id = $('#contract-edit').data('contract_id_edit')
        var windowEdit = $('#dialogEdit').kendoWindow({
                deactivate: function () {
                    this.destroy()
                },
                width: '34%',
                minWidth: 100,
                title: 'Umowa',
                actions: [
                    'Close',
                ],
                close: onClose,
                visible: false,
                position: {
                    top: 100,
                    left: '33%',
                },
                content: {
                    url: API_URL + 'frank/bankcontractget/' + contract_id,
                    dataType: 'json',
                    iframe: false,
                    template: $('#tmpPrint').html(),
                },
            },
        ).data('kendoWindow')

        windowEdit.refresh({
            dataType: 'json',
            template: $('#tmpPrint').html(),
        })
        windowEdit.open().center()
    }

})
