<?php

namespace Mageplaza\HelloWorld\Controller;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use  Magento\Framework\Filesystem;

class Saveimage extends Action
{

    protected $allowedExtensions = ['jpg', 'png', 'jpeg', 'tiff', 'gif']; // to allow file upload types

    protected $_fileUploaderFactory;

    protected $fileSystem;

    public function __construct(
        UploaderFactory $fileUploaderFactory,
        Action\Context $context,
        Filesystem $fileSystem
    ) {

        $this->fileSystem = $fileSystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute()
    {

        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'file']);

        $uploader->setAllowedExtensions($this->allowedExtensions);

        $uploader->setAllowRenameFiles(false);

        $uploader->setFilesDispersion(false);

        $uploader->setAllowCreateFolders(true);

        $uploader->save($this->getDestinationPath());

    }


    /**
     * @return string
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function getDestinationPath()
    {
        return $this->fileSystem
            ->getDirectoryWrite(DirectoryList::TMP)
            ->getAbsolutePath('/');
    }
}