<?php
session_start();

function buatAlert($pesan, $tipe, $icon = 'fas fa-check')
{
  $_SESSION['alert'] = [
    'pesan' => $pesan,
    'tipe' => $tipe,
    'icon' => $icon
  ];
}
function Alert()
{
  if (isset($_SESSION['alert'])) {
    echo '
    <div class="alert alert-' . $_SESSION['alert']['tipe'] . ' alert-dismissible sticky-top fade show" role="alert">
    <span class="alert-inner--icon"><i class="' . $_SESSION['alert']['icon'] . ' fa-fw"></i></span>
      <span class="alert-inner--text">' . $_SESSION['alert']['pesan'] . '</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    ';
    unset($_SESSION['alert']);
  }
}
