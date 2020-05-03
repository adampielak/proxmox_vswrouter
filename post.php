<?php
  include_once("database.php");

  if (isset($_POST['addSwitch'])) {
    add_switch($_POST['switchName'], $_POST['switchType'], $_POST['uplinkType'], $_POST['uplinkIface'], $_POST['uplinkSwitch'], $_POST['uplinkVlan']);
    header("Location: /?page=settings");
  }

  if (isset($_POST['delVlan'])) {
    if (! del_vlan($_POST['switchId'], $_POST['vlanId'])) {
      header("Location: /?page=switch");
    }
  }

  if (isset($_POST['addVlan'])) {
    if (! add_vlan($_POST['switchName'], $_POST['vlanID'], $_POST['ipAddress'], $_POST['maskLength'], $_POST['rtTable'], $_POST['vlanDesc'])) {
      header("Location: /?page=switch");
    }
  }

  if (isset($_POST['saveHASettings'])) {
    if ($_POST['ha_enable'] == "on") {
      set_setting("ha_enable", "1");
    } else {
      set_setting("ha_enable", "0");
    }
    set_setting("ha_mode", $_POST['ha_mode']);
    header("Location: /?page=settings");
  }

  if (isset($_POST['saveSettings'])) {
    set_setting("install_type", $_POST['install_type']);
    header("Location: /?page=settings");
  }

  if (isset($_POST['json'])) {
    if ($_POST['json'] == "getSwitches") {
      $switches = get_switches();
      print json_encode($switches);
      return;
    } elseif ($_POST['json'] == "getVLANs") {
      $vlans = get_switch_vlans($_POST['switch']);
      print json_encode($vlans);
      return;
    }
    print "Hello there\n";
  }
?>
