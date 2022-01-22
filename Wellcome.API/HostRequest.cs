using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.API
{
    public class HostRequest
    {
        public string Email { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }
        public string PictureName { get; set; }
        public AddressDto Address { get; set; }
        public HostConfigurationDto HostConfiguration { get; set; }
        public TravelersConfigurationDto TravelersConfiguration { get; set; }
    }
}
