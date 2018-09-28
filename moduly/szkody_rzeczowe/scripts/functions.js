$(document).ready(function () {
  $('#contract_bona').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })
  $('#contract_transfer_bls').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })
  $('#contract_fiducary_bls').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })

  $('#contract_transfer').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })

  $('#contract_fiducary').kendoTabStrip({
    animation: {
      open: {
        effects: 'fadeIn',
      },
    },
  })

    $("#contractWindow").kendoWindow({
        title: "Edytuj umowę",
        width: "60%",
        modal: true,
        minWidth: 100,
        visible: false,
        position: {
            top: 100,
            left: "20%"
        }
    }).data("kendoWindow");

    $("#printContractWindow").kendoWindow({
        width: "30%",
        modal: true,
        minWidth: 100,
        visible: false,
        position: {
            top: 100,
            left: "34%"
        }
    }).data("kendoWindow");

})
