using Microsoft.AspNetCore.Mvc;
using Wellcome.API;

namespace Wellcome.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class HostsController : ControllerBase
    {
        [HttpPost("presenters")]
        public List<HostPresenter> GetHosts() => new HostsService().GetHostsPresenters();

        [HttpPost("presenters/filter")]
        public List<HostPresenter> GetHosts([FromBody] TripPattern pattern) => new HostsService().GetHostsPresenters(pattern);

        [HttpPost("picture/{id}")]
        public IActionResult GetHostPicture(int id)
        {
           var filestream = new HostsService().GetHostPicture(id);
           return File(filestream, "image/jpeg");
        }


        //[HttpGet]
        //public List<DataModel.Host> GetHosts() => new HostsService().GetHosts();

        //[HttpPost("filter")]
        //public List<DataModel.Host> GetHosts([FromBody] TripPattern pattern) => new HostsService().GetHosts(pattern);

    }
}
