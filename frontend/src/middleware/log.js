export default function log({ next, router })
{
    if(!localStorage.getItem('user_id'))
    {
        return router.push({ name: 'login' });
    }
  
    return next();
}