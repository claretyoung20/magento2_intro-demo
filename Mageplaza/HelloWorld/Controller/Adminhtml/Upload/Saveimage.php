<?php

namespace Mageplaza\HelloWorld\Controller\Adminhtml\Upload;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Store\Model\StoreManagerInterface;

class Saveimage extends Action
{

    protected $allowedExtensions = ['jpg', 'png', 'jpeg', 'tiff', 'gif']; // to allow file upload types

    protected $_fileUploaderFactory;

    protected $_fileSystem;

    protected $_storeManagerInterface;

    public function __construct(
        UploaderFactory $fileUploaderFactory,
        Action\Context $context,
        Filesystem $fileSystem,
        StoreManagerInterface $storeManagerInterface
    ) {

        $this->_fileSystem = $fileSystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_storeManagerInterface = $storeManagerInterface;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute()
    {
        try {
            $returnResult = array();

            $uploader = $this->_fileUploaderFactory->create(['fileId' => 'file']);

            $uploader->setAllowedExtensions($this->allowedExtensions);

            $uploader->setAllowRenameFiles(true);

            $uploader->setFilesDispersion(true);

            $uploader->setAllowCreateFolders(true);

            $path = $this->getDestinationPath();

            $returnResult = $uploader->save($path, $_FILES['image']['name']);

            $returnResult['db_file'] = $this->_fileSystem->getDirectoryWrite(DirectoryList::TMP)->getRelativePath('/') . $uploader->getUploadedFileName();
            $returnResult['url'] = $this->_storeManagerInterface->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .
                $this->_fileSystem->getDirectoryWrite(DirectoryList::TMP)->getRelativePath('co/image') . $uploader->getUploadedFileName();
        }
        catch (\Exception $exception){
            $returnResult = [
                'error' => $exception->getMessage(),
                'error Code' => $exception->getCode(),
                'error Line'=> $exception->getLine(),
                'error trace' => $exception->getTraceAsString()
            ];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($returnResult);

    }


    /**
     * @return string
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function getDestinationPath()
    {
        return $this->_fileSystem
            ->getDirectoryWrite(DirectoryList::TMP)
            ->getAbsolutePath('mega/customOption');
    }
}