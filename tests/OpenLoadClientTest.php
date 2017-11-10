<?php

/*
 * This file is part of the ideneal/openload library
 *
 * (c) Peter Lee <peter279k@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ideneal\OpenLoad\Test\OpenLoadClient;

use Ideneal\OpenLoad\OpenLoadClient;
use Ideneal\OpenLoad\Builder\AccountInfoBuilder;
use Ideneal\OpenLoad\Builder\RemoteUploadBuilder;

/**
 * OpenLoadClientTest
 *
 * @author Peter Lee <peter279k@gmail.com>
 */
class OpenLoadClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string api login
     */
    private $apiLogin;

    /**
     * @var string api key/password
     */
    private $apiKey;

    /**
     * @var object OpenLoadClient
     */
    private $openLoad;

    protected function setUp()
    {
        //$this->apiLogin = getenv('OPENLOAD_API_LOGIN');
        $this->apiLogin = 'OPENLOAD_API_LOGIN';
        //$this->apiKey   = getenv('OPENLOAD_API_KEY');
        $this->apiKey   = 'OPENLOAD_API_KEY';
        $this->openLoad = new OpenLoadClient($this->apiLogin, $this->apiKey);
    }

    public function testGetAccountInfoShouldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getAccountInfo();
    }

    public function testGetTicket()
    {
        $this->assertEquals('72fA-_Lq8Ak3', $this->openLoad->getTicket('72fA-_Lq8Ak3')->getFileId());
    }

    public function testGetDownloadLinkShouldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $ticket = $this->openLoad->getTicket('72fA-_Lq8Ak3');
        $this->openLoad->getDownloadLink($ticket, null);
    }

    public function testGetDownloadLinkWithCaptchaResponseShouldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $ticket = $this->openLoad->getTicket('72fA-_Lq8Ak3');
        $this->openLoad->getDownloadLink($ticket, 'captcha_response');
    }

    public function testGetFilesInfoShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getFilesInfo(['72fA-_Lq8Ak3']);
    }

    public function testGetFileInfoShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getFileInfo('72fA-_Lq8Ak3');
    }

    public function testGetUploadLinkWithHttpOnlyShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getUploadLink('folder_id', sha1('file_contents'), true);
    }

    public function testUploadRemoteFileShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->uploadRemoteFile('https://code.jquery.com/jquery-1.7.2.min.js', 'folder_id', ['header_name' => 'header_value']);
    }

    public function testGetRemoteUploadStatusShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $data         = json_decode('{"id": "12","folderid": "4248"}', true);
        $remoteUpload = RemoteUploadBuilder::buildRemoteUpload($data);
        $this->openLoad->getRemoteUploadStatus($remoteUpload);
    }

    public function testGetLatestRemoteUploadStatusesShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $limit = 10;
        $this->openLoad->getLatestRemoteUploadStatuses($limit);
    }

    public function testGetContentsShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getContents('4248');
    }

    public function testGetFoldersShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getFolders('4248');
    }

    public function testGetFilesShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getFiles('4248');
    }

    public function testSearchFoldersWithRecursiveShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->searchFolders('folder_name', '4248', true);
    }

    public function testSearchFilesWithRecursiveShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->searchFiles('file_name', '4248', true);
    }

    public function testConvertFileShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->convertFile('72fA-_Lq8Ak3');
    }

    public function testGetRunningConversionsShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getRunningConversions('4248');
    }

    public function testGetVideoSplashImageShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->getVideoSplashImage('72fA-_Lq8Ak3');
    }

    public function testuploadFileWithHttpOnlyAndFileNotFoundShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this->openLoad->uploadFile('file_name', '4248', true);
    }

    public function testuploadFileShuoldReturnPermissionDeniedException()
    {
        $this->setExpectedException('Ideneal\OpenLoad\Exception\PermissionDeniedException');
        $this->openLoad->uploadFile(__DIR__.'/../composer.json', '4248');
    }
}
