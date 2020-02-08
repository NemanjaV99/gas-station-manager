<?php

  if (isset($_POST["update-employee"])) {

      $updateEmployee = $this->container->get("UpdateEmployee");
      $updateResult = $updateEmployee->update();

      echo json_encode($updateResult);

  } else {

      $getEmployee = $this->container->get("GetEmployee");
      $getResult = $getEmployee->get();

      if ($getResult["success"]) {
          
          echo json_encode($getResult["result"]);
      }
  }