export default function auth({ next, router })
{
    if(localStorage.getItem('user_id'))
    {
        return router.push({ name: 'home' });
    }
  
    return next();
}