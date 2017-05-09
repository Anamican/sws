<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/user/company/blacklist')) {
                // company_blacklist_create
                if ($pathinfo === '/api/user/company/blacklist') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_company_blacklist_create;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Api\\BlacklistController::createBlackList',  '_format' => 'json',  '_route' => 'company_blacklist_create',);
                }
                not_company_blacklist_create:

                // app_api_blacklist_purgeblacklist
                if ($pathinfo === '/api/user/company/blacklist') {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_app_api_blacklist_purgeblacklist;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Api\\BlacklistController::purgeBlacklist',  '_format' => 'json',  '_route' => 'app_api_blacklist_purgeblacklist',);
                }
                not_app_api_blacklist_purgeblacklist:

                // app_api_blacklist_readblacklist
                if ($pathinfo === '/api/user/company/blacklist') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_app_api_blacklist_readblacklist;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Api\\BlacklistController::readBlacklist',  '_format' => 'json',  '_route' => 'app_api_blacklist_readblacklist',);
                }
                not_app_api_blacklist_readblacklist:

            }

            // app_api_company_getcompany
            if (0 === strpos($pathinfo, '/api/company') && preg_match('#^/api/company/(?P<uniqueSymbol>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_app_api_company_getcompany;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_api_company_getcompany')), array (  '_controller' => 'AppBundle\\Controller\\Api\\CompanyController::getCompanyAction',  '_format' => 'json',));
            }
            not_app_api_company_getcompany:

            if (0 === strpos($pathinfo, '/api/user')) {
                if (0 === strpos($pathinfo, '/api/user/portfolio')) {
                    // app_api_portfolio_createportfolio
                    if ($pathinfo === '/api/user/portfolio') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_app_api_portfolio_createportfolio;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Api\\PortfolioController::createPortfolio',  '_format' => 'json',  '_route' => 'app_api_portfolio_createportfolio',);
                    }
                    not_app_api_portfolio_createportfolio:

                    // app_api_portfolio_deleteportfolio
                    if (preg_match('#^/api/user/portfolio/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_app_api_portfolio_deleteportfolio;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_api_portfolio_deleteportfolio')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PortfolioController::deletePortfolio',  '_format' => 'json',));
                    }
                    not_app_api_portfolio_deleteportfolio:

                    // app_api_portfolio_readportfolio
                    if (preg_match('#^/api/user/portfolio/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_app_api_portfolio_readportfolio;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_api_portfolio_readportfolio')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PortfolioController::readPortfolio',  '_format' => 'json',));
                    }
                    not_app_api_portfolio_readportfolio:

                    // app_api_portfolio_updateportfolio
                    if (preg_match('#^/api/user/portfolio/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PATCH') {
                            $allow[] = 'PATCH';
                            goto not_app_api_portfolio_updateportfolio;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_api_portfolio_updateportfolio')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PortfolioController::updatePortfolio',  '_format' => 'json',));
                    }
                    not_app_api_portfolio_updateportfolio:

                }

                // user_register
                if ($pathinfo === '/api/user/register') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_user_register;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Api\\UserController::registerAction',  '_format' => 'json',  '_route' => 'user_register',);
                }
                not_user_register:

            }

        }

        if (0 === strpos($pathinfo, '/oauth/token')) {
            // oauth_token
            if ($pathinfo === '/oauth/token') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_oauth_token;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\OAuth\\OAuthController::tokenAction',  '_format' => 'json',  '_route' => 'oauth_token',);
            }
            not_oauth_token:

            // oauth_token_info
            if ($pathinfo === '/oauth/token/info') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_oauth_token_info;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\OAuth\\OAuthController::tokenInfoAction',  '_format' => 'json',  '_route' => 'oauth_token_info',);
            }
            not_oauth_token_info:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
