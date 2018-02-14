<?php
namespace command;

class AddScientificWork extends Command {
    function doExecute(\controller\Request $request) {
  		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  			$scientificWorkMapper = \base\RequestRegistry::getScientificWorkMapper();
			
			$scientific_work = new \domain\ScientificWork();  			
  			$scientific_work->year = $request->getProperty('year');
			
			$scientificWorkMapper->insert($scientific_work);
			if (!is_null($scientific_work->id)) {
                $id_scientific_work = $scientific_work->id;
              
                if (sizeof($_FILES) && !$_FILES['document-file']['error'] && $_FILES['document-file']['size'] < 1024 * 2 * 1024) {
                    $upload_info = $_FILES['document-file'];
                    $upload_dir_name = $_SERVER['DOCUMENT_ROOT'] . '/upload/scientific_work/';
                    $file_name = $upload_dir_name.$id_scientific_work;

                    switch ($upload_info['type']) {
                        case 'image/jpeg':
                            $file_name .= '.jpg';
                            break;
                        case 'image/png':
                            $file_name .= '.png';
                            break;
                        case 'application/msword':
                            $file_name .= '.doc';
                            break;
                        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                            $file_name .= '.docx';
                            break;
                        case 'application/pdf':
                            $file_name .= '.pdf';
                            break;
                        default:
                            exit;
                    }
                    $file_name = iconv('utf-8', 'windows-1251', $file_name);
                    
                    if (!file_exists($upload_dir_name)) {
                        mkdir($upload_dir_name, 0777, true);
                    }
                    if (!move_uploaded_file($upload_info['tmp_name'], $file_name)) {
                        $request->setProperty('error', 'Не удалось осуществить сохранение файла');
                    }
                    $scientific_work->file_name = $file_name;
                    $scientificWorkMapper->update($scientific_work);
				}

				return self::statuses('CMD_OK');
			}

			return self::statuses('CMD_ERROR');
  		}
        // return self::statuses('CMD_OK');
    }
}
?>