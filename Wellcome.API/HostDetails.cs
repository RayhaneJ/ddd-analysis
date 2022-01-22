using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.API
{
    public class HostDetails
    {
        public string Title { get; set; }
        public int Travelers { get; set; }
        public int Rooms { get; set; }
        public int Bathrooms { get; set; }
        public string Description { get; set; }
        public AddressDto Address { get; set; }
        public Hoster Hoster { get; set; }
    }
}
