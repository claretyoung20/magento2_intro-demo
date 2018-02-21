<?php

namespace Mageplaza\HelloWorld\Controller\Adminhtml\Upload;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Backend\App\Action;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\UrlInterface;

class Saveimage extends Action
{
    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $imageUploader;

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    protected $_fileSystem;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;


    /**
     * Upload constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Filesystem $filesystem
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        Context $context,
        UploaderFactory $fileUploaderFactory,
        StoreManagerInterface $storeManager,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->imageUploader = $fileUploaderFactory;
        $this->_storeManager = $storeManager;
        $this->_fileSystem = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $result = array();
            $uploader = $this->imageUploader->create(['fileId' => 'image']);
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowCreateFolders(true);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $path = $this->_fileSystem->getAbsolutePath('mary/CustomOption');
            $result = $uploader->save($path, $_FILES['image']['name']);
            $result['db_file'] = $this->_fileSystem->getRelativePath('mary/CustomOption') . $uploader->getUploadedFileName();
            $result['url'] = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) .
                $this->_fileSystem->getRelativePath('mary/CustomOption') . $uploader->getUploadedFileName();
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}