<?php
namespace Firegento\DevDashboard\Controller\Adminhtml\Index;
class Index extends \Magento\Backend\App\Action
{
    
    const ADMIN_RESOURCE = 'Index';       
        
    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;        
        parent::__construct($context);
    }
    
    public function execute()
    {
        var_dump(__METHOD__);
        return $this->resultPageFactory->create();  
    }
}
